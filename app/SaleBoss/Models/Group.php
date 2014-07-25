<?php

namespace SaleBoss\Models;

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;

class Group extends SentryGroup {
	public function setPermissionsAttribute(array $permissions, $merge = true){
		// Merge permissions
		if ($merge)
		{
			$permissions = array_merge($this->getPermissions(), $permissions);
		}

		// Loop through and adjust permissions as needed
		foreach ($permissions as $permission => &$value)
		{
			// Lets make sure their is a valid permission value
			if ( ! in_array($value = (int) $value, $this->allowedPermissionsValues))
			{
				throw new \InvalidArgumentException("Invalid value [$value] for permission [$permission] given.");
			}

			// If the value is 0, delete it
			if ($value === 0)
			{
				unset($permissions[$permission]);
			}
		}

		$this->attributes['permissions'] = ( ! empty($permissions)) ? json_encode($permissions) : '';
	}
}