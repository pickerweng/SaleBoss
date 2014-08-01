<?php namespace SaleBoss\Services\Leads\Importer;


use Maatwebsite\Excel\Facades\Excel;

class ExcelImporter implements ImporterInterface {
    /**
     * Import an excel file from file address
     *
     * @param $fileAddress
     * @return array
     */
    public function import($fileAddress)
    {
        $this->items = Excel::load($fileAddress,function($reader){})->get();

        $firstSheet = $this->items->first()->toArray();

        if(empty($firstSheet))
        {
            return [];
        }

        array_walk($firstSheet,function(&$row, $index){
            if (empty($row['phone_number']))
            {
                unset($row);
            }
            $newRow = [];
            $newRow['phone_number'] = $row['phone_number'];
            $newRow['description'] = empty($row['description']) ? '' : $row['description'];
            $newRow['priority'] = empty($row['priority']) ? 0 : ((int) $row['priority']);
            $newRow['shared'] = true;
            $row = $newRow;
            unset($newRow);
        });

        return $firstSheet;
    }
} 