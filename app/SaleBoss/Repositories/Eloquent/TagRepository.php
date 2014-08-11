<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Tag;
use SaleBoss\Repositories\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Tag $tag)
	{
		$this->model = $tag;
	}
} 