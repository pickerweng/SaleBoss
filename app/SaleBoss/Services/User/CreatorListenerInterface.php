<?php

namespace SaleBoss\Services\User;


interface CreatorListenerInterface {

	/**
	 * What to do when creation fails
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onCreateFail($messages);

	public function onCreateSuccess($message = null);
} 