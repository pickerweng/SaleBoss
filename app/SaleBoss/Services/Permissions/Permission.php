<?php namespace SaleBoss\Services\Permissions;

use Illuminate\Support\Facades\Config;
use SaleBoss\Models\Group;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\GroupRepositoryInterface;
use SaleBoss\Services\Validator\BulkPermissionValidator;

class Permission {

	protected $groupRepo;
	protected $groups;
	protected $permissions = [];
	protected $defaults = [];
	protected $pValidator;

	/**
	 * @param GroupRepositoryInterface $groupRepo
	 * @param BulkPermissionValidator $pValidator
	 */
	public function __construct(
		GroupRepositoryInterface $groupRepo,
		BulkPermissionValidator $pValidator
	){
		$this->groupRepo = $groupRepo;
		$this->pValidator = $pValidator;
	}

	/**
	 * Get all available permissions
	 *
	 * @return array
	 */
	public function run()
	{
		$this->runMerger();
	}

	/**
	 * Gets all permissions inside config
	 *
	 * @return array
	 */
	protected function addConfigPermissions()
	{
		$permissions = Config::get('permissions',array());
		$this->permissions = array_merge($this->permissions,array_flip($permissions));
	}

	/**
	 * Gets all groups permissions
	 *
	 * @return Collection
	 */
	protected function addGroupPermissions()
	{
		$this->groups = $this->groupRepo->getAll();
		$permissions = [];
		foreach($this->groups as $group)
		{
			$permissions = array_merge($permissions,$group->getPermissions());
			$this->addDefaults($group);
		}
		$this->permissions = array_merge($this->permissions, $permissions);
	}

	/**
	 * Add group permissions to defaults
	 *
	 * @param $group
	 * @return void
	 */
	protected function addDefaults(Group $group)
	{
		foreach($group->getPermissions() as $key => $permission)
		{
			$this->defaults[$group->id][$key] = $permission;
		}
	}


	/**
	 * Get permissions property
	 *
	 * @return array
	 */
	public function getPermissions()
	{
		return array_keys($this->permissions);
	}

	/**
	 * Available groups
	 *
	 * @return Collection | array
	 */
	public function getGroups()
	{
		return $this->groups;
	}

	/**
	 * Default group permissions
	 *
	 * @return array
	 */
	public function getDefaults()
	{
		if (empty($this->defaults)){
			$this->addGroupPermissions();
		}
		return $this->defaults;
	}

	/**
	 * Merging user permissions with data
	 *
	 * @return void
	 */
	protected function runMerger()
	{
		$this->addConfigPermissions();
		$this->addGroupPermissions();
	}

	/**
	 * Save Permissions
	 *
	 * @param $data
	 * @param StoreListenerInterface $listener
	 */
	public function save(
		$data,
		StoreListenerInterface $listener
	){
		$valid = $this->pValidator->isValid($data);
		if(! $valid){
			return $listener->onStoreFail($this->pValidator->getErrors());
		}
		$groups = $this->groupRepo->getAll();
		$data = $this->removeInvalidData(
			$data,
			$groups->lists('id','id')
		);

	}

	/**
	 * Remove invalid data from request
	 *
	 * @param $data
	 * @param $groups
	 * @return array
	 */
	protected function removeInvalidData($data,$groups)
	{
		foreach($data as $item => $value)
		{
			if(empty($groups[$item])){
				unset($data[$item]);
			}
		}
		return $data;
	}

} 