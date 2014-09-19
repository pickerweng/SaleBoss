<?php namespace SaleBoss\Services\Leads\Importer;

interface FactoryInterface {
    /**
     * Create an Importer based on product
     *
     * @param $product
     * @return ImporterInterface
     */
    public function make($product);
} 