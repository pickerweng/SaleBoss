<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Lead;
use SaleBoss\Models\Tag;
use SaleBoss\Repositories\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface {

	protected $model;

	public function __construct(Tag $tag)
	{
		$this->model = $tag;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add a tag model to a lead
	 *
	 * @param $lead
	 * @param $tag
	 * @return mixed
	 */
	public function addTagToLead(Lead $lead, Tag $tag)
	{
		$lead->tags()->attach($tag);
		return $lead;
	}

	public function getTagList ($count = null)
	{
		return $this->model->getTagList($count);
	}

    public function syncLeadTags($lead, $array)
    {
        $lead->phones()->sync($array);
        return $lead;
    }
}
