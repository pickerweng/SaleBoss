<?php

namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Collection;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\Model;
use SaleBoss\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

	protected $model;

	/**
	 * @param User $model
	 */
	public function __construct(
		User $model
	){
		$this->model = $model;
	}

	/**
	 * Get All users paginated
	 *
	 * @param $number
	 * @return Collection
	 */
	public function getAllPaginated($number, $internalUser = false)
	{
		$model = $this->model->newInstance();
        if ($internalUser)
        {
            $model = $model->where('is_customer',false);
        }
		return $model->paginate($number);
	}

	/**
	 * Create a user in DB
	 *
	 * @param array $data
	 * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
	 */
	public function create(array $data)
	{
		$model = $this->model->newInstance();
		try {
			return $model->create($data);
		}catch(QueryException $e){
			throw new InvalidArgumentException($e->getMessage());
		}
	}

    /**
     * Updates a user in db
     *
     * @param       $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
     * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
     */
	public function update($id, array $data)
	{
		try {
			$model = $this->model->newInstance();
			$model = $model->find($id);
			if(is_null($model)){
				throw new NotFoundException("No item with id : [{$id}] found");
			}
            if(empty($data['password']))
            {
                $data['password'] = $model->password;
            }
			$model->update($data);
			return $model;
		}catch(QueryException $e){
			throw new InvalidArgumentException($e->getMessage());
		}
	}


	/**
	 * Find a user with groups
	 *
	 * @param $id
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @return Collection
	 */
	public function userWithGroups($id)
	{
		$model = $this->model->newInstance();
		$model = $model->with('groups')->find($id);
		if (is_null($model)){
			throw new NotFoundException("User with id : [{$id}] not found");
		}
		return $model;
	}

	/**
	 * Count users
	 *
	 * @param   null    $filter
	 * @param   int     $remember
	 * @return  int
	 */
	public function count($filter = null,$remember = 0)
	{
		if(empty($filter))
		{
			return $this->model->remember($remember)->count();
		}
		return $this->model->remember($remember)->where($filter,true)->count();
	}

	/**
	 * Get last created user in db
	 *
	 * @return \SaleBoss\Models\User
	 */
	public function getLast()
	{
		$model = $this->model->orderBy('created_at','desc')->first();
		return $model;
	}

	/**
	 * Get generated users in count
	 *
	 * @param $count
	 * @return mixed
	 */
	public function getGeneratedUsers(User $user, $count = 5)
	{
		return $user->generatedUsers()->where('is_customer',true)->take($count)->orderBy('created_at','DESC')->get();
	}

    /**
     * Get all customers of a user
     *
     * @param User  $user
     * @param int   $int
     * @param array $searches
     *
     * @return Collection
     */
    public function getCustomers($user = null, $int = 50, array $searches)
    {
        $query= $this->model->newInstance()->makeSortable();
        foreach($searches as $key => $search)
        {
            if ($search != '')
            {
                if ($key != 'creator_id')
                {
                    $query = $query->where("{$key}","LIKE","%{$search}%");
                }else
                {
                    $query = $query->where('creator_id','=',$search);
                }
            }
        }
        $query = $query->where('is_customer',true);
        if (!is_null($user))
        {
           $query = $query->where('creator_id',$user->id);
        }
        return $query->with('creator')->paginate($int);
    }

    /**
     * Find a customer
     *
     * @param $id
     *
     * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
     * @return Model
     */
    public function findCustomer($id)
    {
        $customer = $this->model
                         ->newInstance()
                         ->with('creator')
                         ->where('id',$id)
                         ->where('is_customer',true)
                         ->first();
        if (is_null($customer))
        {
            throw new NotFoundException("No customer with id: [{$id}] found");
        }
        return $customer;
    }

    /**
     * Perform raw update
     *
     * @param $customer
     * @param $data
     *
     * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
     * @return mixed
     */
    public function rawUpdate($customer, $data)
    {
        try {
            return $customer = $customer->update($data);
        }catch (QueryException $e)
        {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all customers of the user entity
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countAllCustomers($start = null, $end=null, array $query = [])
    {
        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $q->where('is_customer',true);
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        return $q->count();
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all  of the entity
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countAllUsers($start = null, $end = null, array $query = [])
    {
        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $q->where('is_customer',false);
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        return $q->count();
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all users that has came from leads
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countWithLead($start = null, $end = null, array $query = [])
    {
        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $q->whereNotNull('lead_id');
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        return $q->count();
    }
}
