<?php


namespace SaleBoss\Services\Validator;


interface ValidatorInterface {
	/**
	 * Assert that implementor has isValid method
	 *
	 * @param array $input
	 * @param array $messages
	 * @return boolean
	 */
	public function isValid(array $input , $messages=[]);

	/**
	 * @return MessageBag
	 */
	public function getMessages();
} 