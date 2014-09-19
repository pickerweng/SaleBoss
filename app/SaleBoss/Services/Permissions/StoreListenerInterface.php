<?php

namespace SaleBoss\Services\Permissions;

interface StoreListenerInterface {

	/**
	 * What to do when store succeeds
	 *
	 * @param null $message
	 * @return mixed
	 */
	public function onStoreSuccess($message =null);

	/**
	 * What to do when store fails
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onStoreFail($messages);
} 