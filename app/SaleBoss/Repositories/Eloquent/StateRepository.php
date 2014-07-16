<?php namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use Psr\Log\InvalidArgumentException;
use SaleBoss\Models\State;
use SaleBoss\Repositories\Collection;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\StateRepositoryInterface;

class StateRepository  extends AbstractRepository implements StateRepositoryInterface {

	protected $model;

	/**
	 * @param State $model
	 */
	public function __construct(State $model)
	{
		$this->model = $model;
	}

	/**
	 * Updating an State in DB
	 *
	 * @param $id
	 * @param $input
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @return \SaleBoss\Models\State
	 */
	public function update($id, $input)
	{
		$model = $this->model->newInstance()->find($id);
		if (is_null($model))
		{
			throw new NotFoundException("There is no state with id : [{$id}]");
		}
		try {
			$model->title = $input['title'];
			$model->priority = $input['priority'];
			$model->save();
		}catch (QueryException $e){
			throw new InvalidArgumentException("There are problem with your input");
		}
	}

	/**
	 * Saving an State in DB
	 *
	 * @param $input
	 * @return \SaleBoss\Models\State
	 */
	public function create($input)
	{
		try {
			$model = $this->model->newInstance();
			$model->title = $input['title'];
			$model->priority = $input['priority'];
			$model->save();
			return $model;
		}catch(QueryException $e){
			throw new InvalidArgumentException("There are problem with your input");
		}
	}

	/**
	 * Listing State Collection
	 *
	 * @return Collection
	 */
	public function getAll()
	{
		return $this->model->newInstance()->all();
	}
}