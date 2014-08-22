<?php namespace SaleBoss\Services\Tag;

use Config;
use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use SaleBoss\Services\CommandBus\ArtisanCommanderTrait;
use SaleBoss\Services\Tag\Commands\BulkTagStoreCommand;
use Symfony\Component\Console\Input\InputArgument;

class ImportTagCommand extends Command {

	protected $configRepo;

	use ArtisanCommanderTrait;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tags:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @param Repository $configRepo
	 * @return \SaleBoss\Services\Tag\ImportTagCommand
	 */
	public function __construct(
		Repository $configRepo
	){
		parent::__construct();
		$this->configRepo = $configRepo;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$file = $this->argument('file');
		$data = $this->configRepo->get($file, []);
		$data = $this->buildTagData($data);
		$this->commanderExecute(BulkTagStoreCommand::class, ['data' => $data]);
		$this->info("Tags where imported successfully from [{$file}]");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('file', InputArgument::REQUIRED, 'File to be added to tag database.')
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

	private function buildTagData(&$data)
	{
		$configuredData = [];
		foreach($data as &$tag)
		{
			$tmpTag = [];
			$tmpTag['name'] = $tag;
			$configuredData [] = $tmpTag;
			unset($tag);
		}
		return $configuredData;
	}

}
