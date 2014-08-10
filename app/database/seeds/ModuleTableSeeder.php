<?php 
class ModuleTableSeeder extends Seeder {

	protected $moduleRepo;

	public function __construct(ModuleRepositoryInterface $moduleRepo)
	{
		parent::__contruct();
		$this->moduleRepo = $moduleRepo;
	}

	public function run()
	{
		$moduleConfig = Config::get('opilo/modules');
		Cache::forget('module_list');
		foreach($moduleConfig as $config)
		{
			$this->moduleRepo->create($config);
		}
	}
} 