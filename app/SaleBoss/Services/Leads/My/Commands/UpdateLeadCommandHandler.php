<?php  namespace SaleBoss\Services\Leads\My\Commands; 

use Laracasts\Commander\CommandHandler;
use Miladr\Jalali\jDate;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\PhoneRepositoryInterface;
use SaleBoss\Repositories\TagRepositoryInterface;

class UpdateLeadCommandHandler implements CommandHandler {

	protected $leadRepo;
	protected $lead;
	protected $commandData;
    protected $validator;
    protected $tagRepo;
    protected $phoneRepo;

	public function __construct(
		LeadRepositoryInterface $leadRepo,
        UpdateLeadManualValidator $validator,
        PhoneRepositoryInterface $phoneRepo,
        TagRepositoryInterface $tagRepo
	){
		$this->leadRepo = $leadRepo;
        $this->validator = $validator;
        $this->phoneRepo = $phoneRepo;
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
		$this->commandData = $command;
		$this->getLead();
		return $this->updateLead();
	}

	private function getLead()
	{
		$this->lead = $this->leadRepo->findById($this->commandData->id);
		return $this->lead;
	}

	private function updateLead()
	{
        $this->validate(get_object_vars($this->commandData));
        $updateData = $this->getUpdateData();
        $this->phoneRepo->deleteByNumber($this->lead->phones->first()->number);
        $this->phoneRepo->addPhoneToLead($this->lead, $this->commandData->phone);
        foreach($this->lead->tags() as $tag)
        {
            $tag->delete();
        }
        if (!empty($this->commandData->tag))
        {
            $this->tagRepo->addTagToLead($this->lead, $this->getTag($this->commandData->tag));
        }
        if (empty($updateData['remind_at']))
        {
           $updateData['remind_at'] = null;
        }else {
            $updateData['remind_at'] = $this->getRemindAtFromDays($updateData['remind_at']);
        }
		return $this->leadRepo->update($this->lead, $updateData);
	}

	private function getUpdateData()
	{
		$neededData = ['name', 'description', 'priority', 'remind_at','status'];
		$data = [];
		foreach ($neededData as $key) {
            if (isset($this->commandData->$key)) {
                $data[$key] = $this->commandData->$key;
            }
        }
		return $data;
	}

    private function validate (array $data)
    {
        $this->validator->setUpdate($this->lead->phones->first()->id);
        $this->validator->validate($data);
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Create or find tag
     *
     * @param $tagName
     * @return mixed
     */
    private function getTag($tagName)
    {
        try{
            if (is_numeric($tagName)) {
                $tag = $this->tagRepo->findById($tagName);
            }else {
                $tag = $this->tagRepo->findByName($tagName);
            }
            return $tag;
        }catch (NotFoundException $e){
            return $tag = $this->tagRepo->createRaw(['name' => $tagName]);
        }
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get data from future days
     *
     * @param $remindAt
     * @return null
     */
    private function getRemindAtFromDays($remindAt)
    {
        if (empty($remindAt)) return null;
        return $remindAt = jDate::forge("now + {$remindAt} days")->time();
    }


}
