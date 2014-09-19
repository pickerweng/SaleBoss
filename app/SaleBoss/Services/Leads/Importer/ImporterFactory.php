<?php namespace SaleBoss\Services\Leads\Importer;

use Illuminate\Support\Facades\App;

class ImporterFactory implements FactoryInterface{

    protected $product;
    protected $madeProduct;

    /**
     * Create an Importer based on product
     *
     * @param $product
     * @return ImporterInterface
     */
    public function make ($product)
    {
        $this->product = $product;

        return $this->makeProduct();
    }

    /**
     * Generate class name based on product
     *
     * @return string
     */
    private function getClassName()
    {
        return "SaleBoss\\Services\\Leads\\Importer\\" . ucfirst(camel_case($this->product)) . "Importer";
    }

    /**
     * @return mixed
     * @throws FactoryException
     * @return ImporterInterface
     */
    protected function makeProduct()
    {
        $class = $this->getClassName();
        if ( ! class_exists($class))
        {
            throw new FactoryException("Invalid or not supported type for importer");
        }
        return $this->madeProduct = App::make($class);
    }
}