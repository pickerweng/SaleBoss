<?php namespace SaleBoss\OpiloOrders;

interface OrderCreatorListenerInterface {
	/**
	 * What happens when creation fails
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onCreateFail($messages);
} 