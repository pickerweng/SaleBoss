<?php namespace SaleBoss\Repositories;

use SaleBoss\Models\Lead;
use SaleBoss\Models\Tag;

interface TagRepositoryInterface {

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add a tag model to a lead
	 *
	 * @param $lead
	 * @param $tag
	 * @return mixed
	 */
	public function addTagToLead(Lead $lead, Tag $tag);

	public function createRaw(array $tag);
}