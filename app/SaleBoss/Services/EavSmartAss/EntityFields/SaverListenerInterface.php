<?php namespace SaleBoss\Services\EavSmartAss\EntityFields;

interface SaverListenerInterface {
	/**
	 * What to do when Save fails
	 *
	 * @param $messages
	 * @return
	 */
	public function onSaveFail($messages);

	/**
	 * What to do when when validation suceeds
	 *
	 * @param $message
	 * @return
	 */
	public function onSaveSuccess($message);
} 