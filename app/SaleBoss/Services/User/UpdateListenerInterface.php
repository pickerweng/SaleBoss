<?php namespace SaleBoss\Services\User;

interface UpdateListenerInterface {

	/**
	 * What to do when user update fails
	 *
	 * @param $messages
	 * @return
	 */
	public function onUpdateFail($messages);

	/**
	 * What to do when user update succeeds
	 *
	 * @param null  $message
	 * @return
	 */
	public function onUpdateSuccess($message = null);

	/**
	 * What to do when user is not found for update
	 *
	 * @return
	 */
	public function onUpdateNotFound();
}