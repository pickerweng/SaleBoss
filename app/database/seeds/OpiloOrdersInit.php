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
		$model = $this->eavManager->createAndSetEntityType([
			'machine_name'  =>  'opilo_orders',
			'display_name'  =>  'سفارش های اپیلو'
		]);
		$model->addAttributes([
			[
				'machine_name'  =>  'id_code',
				'display_name'  =>  'کد ملی'
			],
			[
				'machine_name'  =>  'first_name'
			]
		]);
	}
} 