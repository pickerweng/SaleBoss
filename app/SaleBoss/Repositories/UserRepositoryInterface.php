<?php

namespace SaleBoss\Repositories;


interface UserRepositoryInterface {

	/**
	 * Get All users paginated
	 *
	 * @param $number
	 * @return Collection
	 */
	public function getAllPaginated($number);
}