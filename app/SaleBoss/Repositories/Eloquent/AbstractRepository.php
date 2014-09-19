<?php

namespace SaleBoss\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;

class AbstractRepository {

	/**
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add the ability to find by property
	 *
	 * @param $method
	 * @param $args
	 * @return mixed
	 */
	public function __call($method, $args)
	{
		if ($this->isFindable($method))
		{
			$property = $this->getFindByProperty($method);
			return call_user_func_array([$this, 'findBy'], [$property, $args[0]]);
		}
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Find a model by property
	 *
	 * @param $property
	 * @param $value
	 * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
	 * @return mixed
	 */
	public function findBy ($property, $value)
	{
		try {
			$model =  $this->model->where($property,'=',$value)->first();
		}catch (QueryException $e){
			dd($e->getMessage());
			throw new RepositoryException($e->getMessage());
		}
		if (is_null($model))
		{
			throw new NotFoundException("No model with {$property} = {$value} found");
		}
		return $model;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Check that if a magic method argument is findable or not
	 *
	 * @param $method
	 * @return bool
	 */
	private function isFindable($method)
	{
		if (Str::startsWith($method, 'findBy'))
		{
			return true;
		}
		return false;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Get property from findBy magic method
	 *
	 * @param $method
	 * @return mixed
	 */
	private function getFindByProperty($method)
	{
		return strtolower(str_replace('findBy','',$method));
	}

	/**
	 * Delete an item from Repository
	 *
	 * @param $id
	 * @return bool|null
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 */
	public function delete($id)
	{
		$model = $this->model->newInstance();
		$model = $model->find($id);
		if(is_null($model)){
			throw new NotFoundException("Not item with id : [{$id}] found");
		}
		return $model->delete();
	}

	/**
	 * Find a user in DB based on ID
	 *
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Collection|Model|static
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 */
	public function findById($id)
	{
		$model = $this->model->newInstance();
		$model = $model->find($id);
		if(is_null($model)){
			throw new NotFoundException("No Item with id : [{$id}] found");
		}
		return $model;
	}

    /**
     * Creating item from raw data
     *
     * @param array $data
     *
     * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
     * return Model
     */
    public function createRaw (array $data)
    {
        try {
            return $this->model->newInstance()->create($data);
        } catch (QueryException $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

	/**
	 * Delete a model with instance of model given
	 *
	 * @param Model $model
	 * @throws \Exception
	 * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
	 * @return Model
	 */
	public function deleteByModel(Model $model)
	{
		try {
			$model->delete();
			return $model;
		}catch (QueryException $e) {
			throw new RepositoryException($e->getMessage());
		}
	}

	/**
	 * Delete an eloquent model based on id
	 *
	 * @param $id
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
	 * @return null
	 */
	public function deleteById($id)
	{
		return $this->delete($id);
	}

    /**
     * Count all
     *
     * @param null $before
     * @return int
     */
    public function countAll($before = null)
    {
        $q = $this->model->newInstance()->getQuery();
        if (! empty($before)){
            $q = $q->where('created_at', '>',$before);
        }
        return $q->count();
    }

    /**
     * Count with query
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return mixed
     */
    public function countWithQuery($start = null, $end = null, array $query = [])
    {
        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        return $q->count();
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Add simple wheres to the query
     *
     * @param $q
     * @param array $queries
     * @return mixed
     */
    protected function addSimpleWheres($q, array $queries)
    {
        foreach($queries as $key =>  $value){
            $q = $q->where($key, $value);
        }
        return $q;
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Add start range for the one of the available date ex. created_at
     *
     * @param $q
     * @param $start
     * @param string $for
     * @return mixed
     */
    protected function addStartRange($q, $start, $for = 'created_at')
    {
        return $q = $start ? $q->where($for, '>=', $start) : $q;
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Add end range for the one of the available dates ex. created_at
     *
     * @param $q
     * @param $end
     * @param string $for
     * @return mixed
     */
    protected function addEndRange($q, $end, $for = 'created_at')
    {
        return $q = $end ? $q->where($for, '<', $end) : $q;
    }
}
