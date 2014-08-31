<?php namespace SaleBoss\Models; 

use Illuminate\Database\Eloquent\Model;

class BaseEloquent extends Model
{
    public function getFullTableName()
    {
        return $this->getConnection()->getTablePrefix() . $this->getTable();
    }
} 
