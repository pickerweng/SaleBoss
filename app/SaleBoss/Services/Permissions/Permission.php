<?php namespace SaleBoss\Services\Permissions;

use Illuminate\Support\Facades\Config;
use SaleBoss\Repositories\GroupRepositoryInterface;

class Permission {

	protected $groups;
	protected $permissions = [];

	/**
	 * @param GroupRepositoryInterface $groups
	 */
	public function __construct(
		GroupRepositoryInterface $groups
	){
		$this->groups = $groups;
	}

	/**
	 * Get all available permissions
	 *
	 * @return array
	 */
	public function getAll()
	{
		$this->addConfigPermissions();
		$this->addGroupPermissions();

		return $this->getPermissions();
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
		$groups = $this->groups->getAll();
		$permissions = [];
		foreach($groups as $group)
		{
			$permissions = array_merge($permissions,$group->getPermissions());
		}
		$this->permissions = array_merge($this->permissions, $permissions);
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
} 