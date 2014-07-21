<?php namespace SaleBoss\OpiloOrders;

use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\EavSmartAss\EavManager;
use SaleBoss\Services\Validator\OrderValidator;
use Whoops\Example\Exception;

class OrderCreator {

	protected $manager;
	protected $oRepo;
	protected $userRepo;
	protected $validator;
	protected $li;
	protected $entityData;

	/**
	 * @param EavManager $manager
	 * @param OrderRepositoryInterface $oRepo
	 * @param UserRepositoryInterface $userRepo
	 * @param OrderValidator $validator
	 */
	public function __construct(
		EavManager $manager,
		OrderRepositoryInterface $oRepo,
		UserRepositoryInterface $userRepo,
		OrderValidator $validator
	){
		$this->manager = $manager;
		$this->oRepo = $oRepo;
		$this->userRepo = $userRepo;
		$this->manager->setType('orders');
		$this->validator = $validator;
	}

	/**
	 * External Action Listener
	 *
	 * @param OrderCreatorListenerInterface $li
	 * @return $this
	 */
	public function setListener(OrderCreatorListenerInterface $li)
	{
		$this->li = $li;
		return $this;
	}

	/**
	 * Set data of the Order
	 *
	 * @param $data
	 * @return $this
	 */
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * Process the save
	 *
	 * @return mixed
	 */
	public function create()
	{
		if ( !$valid = $this->validator->isValid($this->data) )
		{
			return $this->li->onCreateFail($this->validator->getMessages());
		}
		try
		{
			$this->saveEntity();
			$this->addValues();
			return $this->li->onCreateSuccess(Lang::get('messages.operation_success'));
		}catch (RepositoryException $e)
		{
			return $this->li->onCreateFail([Lang::get('messages.operation_error')]);
		}

	}

	/**
	 * Save Entity in DB
	 *
	 * @return $this
	 * @throws \Whoops\Example\Exception
	 */
	protected function saveEntity()
	{
		$this->setEntityData();
		$this->manager->createAndSetEntity($this->getEntityData());
		return $this;
	}

	/**
	 * Generate Entity Data from general data
	 *
	 * @return $this
	 * @throws \Whoops\Example\Exception
	 */
	protected function setEntityData()
	{
		if(is_null($this->data))
		{
			throw new Exception("You have not set order data.");
		}
		$this->entityData['title'] = empty($this->data['title']) ? '' : $this->data['title'];
		$this->entityData['description'] = empty($this->data['description']) ? null : $this->data['description'];
		$this->entityData['data'] = ! empty($this->data['data']) ? json_encode($this->data['data']) : null;
		return $this;
	}

	/**
	 * Get Entity Data
	 *
	 * @return mixed
	 */
	protected function getEntityData()
	{
		return $this->entityData;
	}

	/**
	 * @return $this
	 */
	protected function addValues()
	{
		$attributes = $this->manager->getAttributes();
		foreach($attributes as $attr)
		{
			if (!   empty($this->data[$attr->machine_name]))
			{
				$this->manager->addValue($attr->id, $this->data[$attr->machine_name]);
			}
		}
		$this->manager->saveValues();
		return $this;
	}
} 