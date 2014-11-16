<?php namespace SaleBoss\Services\Leads\Creator;

use Carbon\Carbon;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Validator\LeadValidator;

class Creator implements CreatorInterface {

    protected $userRepo;
    protected $leadRepo;
    protected $leadValidator;
    protected $listener;
    protected $data;
    protected $events;
    protected $before = 0;
    protected $creator = null;

    /**
     * @param UserRepositoryInterface                        $userRepo
     * @param \SaleBoss\Repositories\LeadRepositoryInterface $leadRepo
     * @param \SaleBoss\Services\Validator\LeadValidator     $leadValidator
     * @param \Illuminate\Events\Dispatcher                  $events
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        LeadRepositoryInterface $leadRepo,
        LeadValidator $leadValidator,
        Dispatcher $events
    ){
        $this->userRepo = $userRepo;
        $this->leadRepo = $leadRepo;
        $this->leadValidator = $leadValidator;
        $this->events = $events;
    }

    public function setListener(CreatorListenerInterface $listener)
    {
        $this->listener = $listener;
        return $this;
    }

    /**
     * Bulk Create leads
     *
     * @param array $data
     * @return mixed
     */
    public function bulkCreate(array $data, $user_id = null)
    {
        $this->setData($data, $user_id);
        $this->filterData();
        if (empty($this->data))
        {
            return $this->listener->onCreateFail(Lang::get("messages.empty_bulk_lead"));
        }

        try
        {
            $this->doStore();
            return $this->listener->onCreateSuccess(Lang::get(
                'messages.success_lead_creation',
                ['count'   =>  count($this->data), 'before' => $this->before]
            ));
        }catch (RepositoryException $e)
        {
            Log::info($e->getMessage());
            return $this->listener->onCreateFail(Lang::get('messages.database_error'));
        }
    }

    /**
     * Single lead creation
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->bulkCreate([$data]);
    }

    /**
     * Set the creation data class will work on this
     *
     * @param array $data
     * @return $this
     */
    private function setData(array $data, $user_id = null)
    {
        $this->data = $data;
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Filter invalid data
     *
     * @return void
     */
    private function filterData()
    {
        if($this->user_id == 'local_user')
        {
            foreach($this->data as $key => &$lead)
            {
                $lead['description'] = empty($lead['description']) ? '' : $lead['description'];
                $lead['priority'] = empty($lead['priority']) ? 1 : $lead['priority'];
                $lead['tag_id'] = empty($lead['tag_id']) ? 182 : ((int) $lead['tag_id']);
                $lead['creator_id'] = empty($lead['creator_id']) ? null : $lead['creator_id'];
                $lead['new_lead'] = '1';
                $lead['created_at'] = Carbon::now();
                $lead['updated_at'] = Carbon::now();
                if (!$valid = $this->leadValidator->isValid($lead)) {
                    unset($this->data[$key]);
                    $this->before++;
                }
            }

        }
            else
            {
                foreach($this->data as $key => &$lead)
                {
                    $lead['description'] = empty($lead['description']) ? '' : $lead['description'];
                    $lead['priority'] = empty($lead['priority']) ? 1 : $lead['priority'];
                    $lead['tag_id'] = empty($lead['tag_id']) ? 182 : ((int) $lead['tag_id']);
                    $lead['creator_id'] = $this->user_id;
                    $lead['new_lead'] = '1';
                    $lead['created_at'] = Carbon::now();
                    $lead['updated_at'] = Carbon::now();
                    if (!$valid = $this->leadValidator->isValid($lead)) {
                        unset($this->data[$key]);
                        $this->before++;
                    }
                }
            }
    }

    /**
     * Get only some variables of a tow-level nested array
     *
     * @param $filterable
     * @param array $keep
     * @return array
     */
    public static function doFilter(&$filterable, $keep)
    {
        $keepable = [];
        foreach($filterable as $key => $value){
            foreach($keep as $what){
                if(isset($value[$what])){
                    $keepable[$key][$what] = $value[$what];
                }
            }
        }
        $filterable = null;
        return $keepable;
    }

    /**
     * Process store
     */
    private function doStore()
    {
        $this->leadRepo->bulkCreate($this->data, $this->creator);
        $this->events->fire('leads.inserted',[$this->data]);
    }

    /**
     * Set this lead group creator
     *
     * @param User $creator
     * @return $this
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Count data
     *
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }
}