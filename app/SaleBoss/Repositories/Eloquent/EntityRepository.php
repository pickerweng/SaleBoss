<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 06:06 PM
 */

namespace SaleBoss\Repositories\Eloquent;


use SaleBoss\Models\Entity;
use SaleBoss\Models\EntityType;
use SaleBoss\Repositories\EntityRepositoryInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;

class EntityRepository implements EntityRepositoryInterface{

	protected $model;

	public function __construct(
		Entity $model
	){
		$this->model = $model;
	}

	/**
	 * @param EntityType $type
	 * @param $data
	 * @return \Illuminate\Database\Eloquent\Model|static
	 */
	public function create(EntityType $type , $data)
	{
		$model = $this->model->newInstance();
		$model->title = $data['title'];

		if( !empty($data['description'])){
			$model->description = $data['description'];
		}

		if( !empty($data['data'])){
			$model->data = $data['data'];
		}

		$type->entities()->save($model);

		return $model;
	}

	/**
	 * Gets all entities of a given type
	 *
	 * @param EntityType $type
	 * @return mixed
	 */
	public function getEntitiesOf(EntityType $type)
	{
		return $type->entities()->get();
	}

	/**
	 * Gets paginated entities of a type
	 *
	 * @param EntityType $type
	 * @param bool $number
	 * @return mixed
	 */
	public function getPaginatedEntitiesOf(EntityType $type, $number = false)
	{
		if($number === false)
			return $this->getEntitiesOf($type);

		return $type->pageinate($number);
	}

	/**
	 * Get Full entity with attributes and values
	 * @param $id
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @return mixed
	 */
	public function fullEntityById($id)
	{
		$entity = $this->model->with(['entityValues' => function($query){
			$query->with(['attribute']);
		}])->find($id);

		if (is_null($entity))
			throw new NotFoundException("Entity with id: {$id} not found");

		return $entity->toArray();
	}
}