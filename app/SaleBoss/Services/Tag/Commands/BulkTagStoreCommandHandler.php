<?php  namespace SaleBoss\Services\Tag\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\TagRepositoryInterface;

class BulkTagStoreCommandHandler implements CommandHandler {

	protected $tagRepo;

	public function __construct(
		TagRepositoryInterface $tagRepo
	){
		$this->tagRepo = $tagRepo;
	}


	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		foreach ($command->data as $tag){
			$this->tagRepo->createRaw($tag);
		}
	}
}