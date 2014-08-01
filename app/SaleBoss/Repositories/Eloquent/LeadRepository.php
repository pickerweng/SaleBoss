<?php namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use SaleBoss\Models\Lead;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
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
           }catch (QueryException $e){
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
     * Get paginated list of leads
     *
     * @param int    $int
     * @param bool   $withLocker
     * @param array  $search
     * @param string $sort
     * @param bool   $asc
     * @return mixed
     */
    public function getPaginated ($int = 50, $withLocker = true, array $search = [], $sort = 'created_at', $asc = false)
    {
        $leads = $this->model->newInstance();
        $leads = empty($withLocker) ? $leads : $leads->with('locker');
        if (! empty($search['id']))
        {
            $leads = $leads->where('id','=',$search['id']);
        }
        if (! empty($search['locker_id']))
        {
            $leads = $leads->where('locker_id','=',$search['locker_id']);
        }
        if (! empty($search['locker']))
        {
            $leads = $leads->whereHas('locker',function($q) use($search){
               $q->where(DB::raw("CONCAT(first_name,' ',last_name)"),'LIKE','%' . $search['locker'] . "%")
                 ->orWhere("email","LIKE", "%{$search['locker']}%");
            });
        }
        if (!empty($search['description']))
        {
            $leads = $leads->where('description','LIKE','%'. $search['description'] . '%');
        }
        if (!empty($search['priority']))
        {
            $leads = $leads->where('priority','=',$search['priority']);
        }
        if(!empty($search['status']))
        {
           $leads = $leads->where('status','=',$search['status']);
        }
        if( ! empty($search['has_remind_at']))
        {
            $leads = $leads->whereNotNull('remind_at');
        }
        if (in_array($sort,['created_at','updated_at','locked_at','locker_id','priority','status']))
        {
            $leads = $leads->orderBy($sort, empty($asc) ? 'DESC' : 'ASC');
        }
        return $leads->paginate($int);
    }

    /**
     * Get users last lead
     *
     * @param User $user
     * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
     * @return Lead
     */
    public function getUserLastLockedLead (User $user)
    {
        $lastLead = $user->lockedLeads()->orderBy('locked_at','DESC')->first();
        if (is_null($lastLead))
        {
            throw new NotFoundException("No Leads found for user");
        }
        return $lastLead;
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
     * Get user leads that has argument status
     *
     * @param \SaleBoss\Models\User $user
     * @param                       $int
     * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
     * @return mixed
     */
    public function getUserLeadsWithStatus (User $user,$int)
    {
        $lead = $user->lockedLeads()->where('status','=',$int)->first();
        if (is_null($lead))
        {
            throw new NotFoundException("User with id: [{$user->id}] has no leads with status: [{$int}]");
        }
        return $lead;
    }

    public function countLockedForUser(User $user, $status = '')
    {
        if ($status !== '')
        {
            return $user->lockedLeads()->where('status',$status)->count();
        }
        return $user->lockedLeads()->count();
    }
}