<?php

namespace SaleBoss\Repositories;

use SaleBoss\Models\Order;
use SaleBoss\Models\User;

interface OrderRepositoryInterface {

    /**
     * Create order from raw data
     *
     * @param $data
     *
     * @return Order
     */
    public function createRaw(array $data);

	/**
	 * Get generated orders of users ord user
	 *
	 * @param null $user
	 * @param $int
	 * @return mixed
	 */
	public function getGeneratedOrders($user = null, $int);



	/**
	 * Get available orders of user
	 *
	 * @param User $user
	 * @param $perms
	 * @param $int
	 * @return mixed
	 */
	public function getAvailableOrders(User $user = null,$perms, $int);

	/**
	 * Count orders in month
	 *
	 * @return mixed
	 */
	public function countableMonthChart();

	/**
	 * Update order
	 *
	 * @param $order
	 * @param $data
	 * @return mixed
	 */
	public function update(Order $order,array $data);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get Searchable order list paginated
     *
     * @param $int
     * @return mixed
     */
    public function getSearchableOrders ($int);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all orders
     *
     * @param null $before
     * @return mixed
     */
    public function countAll($before = null);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get score list based on sale
     *
     * @param null  $start
     * @param null  $end
     * @param array $queries
     * @return Collection
     */
    public function getScoreList($start = null, $end = null, array $queries = []);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Sum panel price
     *
     * @param null  $start
     * @param null  $end
     * @param array $query
     * @return mixed
     */
    public function sumPanelPrice($start = null, $end = null, $query = []);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count price of leaded orders by a user
     *
     * @param null  $start
     * @param null  $end
     * @param array $query
     * @return int
     */
    public function leadedOrdersStats($start = null, $end = null, array $query = []);

}
