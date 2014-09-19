<?php namespace Controllers;

use Illuminate\Support\Facades\Input;
use SaleBoss\Services\Leads\Creator\CreatorListenerInterface;
use SaleBoss\Services\Leads\Importer\ImporterService;
use SaleBoss\Services\Leads\Importer\ImporterServiceListenerInterface;

class LeadImporterController extends BaseController
    implements ImporterServiceListenerInterface, CreatorListenerInterface
{

    protected $importer;

    public function __construct(
        ImporterService $importerService
    ){
        $this->importer = $importerService;
    }

    public function create()
    {
        return $this->view("admin.pages.lead.importer.create");
    }

    public function store()
    {
        $file = Input::file('file');
        $this->importer->setListener($this);
        return $this->importer->import($file);
    }

    /**
     * What to do when import fails
     *
     * @param $messages
     * @return mixed
     */
    public function onImportFail ($messages)
    {
        return $this->redirectBack()->withErrors($messages);
    }

    /**
     * What to when saving into  database fails
     *
     * @param messages
     * @return mixed
     */
    public function onCreateFail ($messages)
    {
        return $this->redirectBack()->withErrors($messages);
    }

    /**
     * What to when creation succeeds
     *
     * @param null $message
     * @internal param $messages
     * @return mixed
     */
    public function onCreateSuccess ($message = null)
    {
        return $this->redirectBack()->with('success_message',$message);
    }
}