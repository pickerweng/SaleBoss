<?php

namespace SaleBoss\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
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
        }catch (QueryException $e)
        {
            throw new RepositoryException($e->getMessage());
        }
    }

}