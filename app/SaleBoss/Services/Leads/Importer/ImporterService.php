<?php namespace SaleBoss\Services\Leads\Importer;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Services\Leads\Creator\CreatorInterface;
use SaleBoss\Services\Validator\LeadImporterValidator;

class ImporterService {

    protected $iValidator;
    protected $listener;
    protected $importerFactory;
    protected $importer;
    protected $savableItems;
    protected $creator;

    /**
     * @param LeadImporterValidator                             $iVal
     * @param FactoryInterface                                  $importerFactory
     * @param \SaleBoss\Services\Leads\Creator\CreatorInterface $creator
     * @internal param \SaleBoss\Repositories\LeadRepositoryInterface $leadRepo
     */
    public function __construct(
        LeadImporterValidator $iVal,
        FactoryInterface $importerFactory,
        CreatorInterface $creator
    ){
        $this->iValidator = $iVal;
        $this->importerFactory = $importerFactory;
        $this->creator = $creator;
    }

    /**
     * Sets listener that uses this class
     *
     * @param ImporterServiceListenerInterface $listener
     * @return $this
     */
    public function setListener(ImporterServiceListenerInterface $listener)
    {
        $this->listener = $listener;
        return $this;
    }

    /**
     * Public importer function
     *
     * @param $file
     * @return mixed
     */
    public function import($file)
    {
        $this->file = $file;

        if (! $this->iValidator->isValid(['file' => $this->file],['mimes' => Lang::get("messages.invalid_file_type")]))
        {
            return $this->listener
                        ->onImportFail($this->iValidator->getMessages());
        }

        try {
            $this->creator->setListener($this->listener);
            return $this->creator->bulkCreate($this->doImport());
        }catch (FactoryException $e)
        {
            Log::info($e->getMessage());
            return $this->listener
                        ->onImportFail(Lang::get("messages.operation_error"));
        }catch(RepositoryException $e)
        {
            Log::info($e->getMessage());
            return $this->listener
                        ->onImportFail(Lang::get("messages.database_error"));
        }
    }

    /**
     * Process Import and return count
     *
     * @return int
     */
    private function doImport()
    {
        $this->importer = $this->importerFactory
                               ->make($this->file->getClientOriginalExtension());
        return $this->importer
                    ->import($this->file->getRealPath());
    }
}