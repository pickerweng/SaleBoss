<?php

use SaleBoss\Services\EavSmartAss\EavManagerInterface;

class OpiloOrdersInit extends Seeder {
	protected $eavManager;

	/**
	 * @param EavManagerInterface $eavManager
	 * @internal param EavManagerInterface $eavMan
	 */
	public function __construct(
		EavManagerInterface $eavManager
	){
		$this->eavManager = $eavManager;
	}

	/**
	 * Run the Seeder for opilo orders module
	 *
	 * @return void
	 */
	public function run()
	{
		/*$model = $this->eavManager->createAndSetEntityType([
			'machine_name'  =>  'opilo_orders',
			'display_name'  =>  'سفارش های اپیلو'
		]);*/
		$this->eavManager->setType('opilo_orders')->addAttributes([
				/*[
					'display_name'  => 'شماره خط اختصاصی',
					'machine_name'  =>  'private_number',
					'form_type'     =>  'text'
				]*/
				/*[
					'display_name'  =>  'نوع پرداخت',
					'machine_name'  =>  'payment_method',
					'form_type'     =>  'select',
					'options'   =>  json_encode([
						'online' => 'آنلاین',
						'cart' =>  'کارت به کرت',
						'pos' =>   'کارتخوان',
						'cash' => 'نقدی'
					])
				]*/

			]
		);
	}
} 