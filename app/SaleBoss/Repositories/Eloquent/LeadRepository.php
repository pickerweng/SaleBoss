<?php namespace SaleBoss\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use SaleBoss\Models\Lead;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\LeadRepositoryInterface;

class LeadRepository extends AbstractRepository implements LeadRepositoryInterface {

    protected $model;

    /**
     * @param Lead $lead
     */
    public function __construct(Lead $lead)
    {
        $this->model = $lead;
    }

    /**
     * Bulk Lead creation
     *
     * @param array $data
     * @param User  $user
     * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
     * @return mixed
     */
    public function bulkCreate (array $data, User $user = null)
    {
        $data = $this->setCreatorId($data, !empty($user) ? $user->id : null);
        DB::beginTransaction();
           try {
               $this->model->newInstance()->insert($data);
           } catch(QueryException $e) {
               DB::rollback();
               throw new RepositoryException($e->getMessage());
           }
        DB::commit();
    }

    /**
     * Set creator id on data
     *
     * @param array $data
     * @param       $creator_id
     * @return array
     */
    private function setCreatorId(array $data, $creator_id)
    {
        foreach($data as &$item)
        {
            $item['creator_id'] = $creator_id;
        }
        return $data;
    }


    /**
     * Count available leads
     *
     *
     * @return int
     */
    public function count ()
    {
        return $this->model->newInstance()->count();
    }

    /**
     * Update a lead
     *
     * @param \SaleBoss\Models\Lead $lead
     * @param array                 $data
     * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
     * @return mixed
     */
    public function update (Lead $lead, array $data = [])
    {
        if (empty($data)){
            $lead->save();
            return $lead;
        }
        try {
            $lead->update($data);
            return $lead;
        }catch (QueryException $e){
            throw new InvalidArgumentException($e->getMessage());
        }
    }

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add relationships to a lead
	 *
	 * @param Lead $lead
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getAllForLead(Lead $lead)
	{
		return $lead->load('phones','tags');
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Get user leads
	 *
	 * @param User $user
	 * @param int $int
	 * @return mixed
	 */
	public function getUserLeads(User $user, $int = 25)
    {
        return $user->createdLeads()->with('tags','phones')->orderBy('created_at','DESC')->paginate($int);
    }

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Get user leads between a date
	 *
	 * @param User $user
	 * @param $todayStart
	 * @param $todayEnd
	 * @return mixed
	 */
	public function getUserLeadsBetween(User $user, $todayStart, $todayEnd)
    {
        $todayStart = Carbon::createFromTimestamp($todayStart)->toDateString();
        $todayEnd = Carbon::createFromTimestamp($todayEnd)->toDateString();
        return $user->createdLeads()
                    ->with('tags','phones')
                    ->whereBetween('remind_at',array($todayStart, $todayEnd))
                    ->get();
    }

	public function getCountableStatuses(User $user, $before = null)
	{
		if (is_null($before))
		{
			return $user->createdLeads()
				        ->getQuery()
						->groupBy('status')
						->get(array('status', DB::raw('count(*) as total')));
		}
        $before = Carbon::createFromTimestamp((int) $before);
		return $user->createdLeads()
					->getQuery()
					->where('created_at','>', $before->toDateString())
					->groupBy('status')
					->get(array('status', DB::raw('count(*) as total')));
	}

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Reminding leads of the user
     *
     * @param User $user
     * @param int $int
     * @return mixed
     */
    public function getRemindableLeads(User $user, $int = 50)
    {
        $todayStart = Carbon::createFromTimestamp(time())->startOfDay()->toDateTimeString();
        return $user->createdLeads()
                    ->where('remind_at', '>', $todayStart)
                    ->with('tags','phones')
                    ->orWhere(function($q) use($user){
                        $q->where('updated_at','<','remind_at')
                          ->where('creator_id',$user->id)
                          ->whereNotNull('remind_at');
                    })
                    ->orderBy('remind_at','ASC')
                    ->take($int)->get();
    }
}
