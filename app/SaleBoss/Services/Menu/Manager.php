<?php
namespace SaleBoss\Services\Menu;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Manager implements ManagerInterface {

    /**
     * @param Builder $builder
     */
    public function __construct(
        Builder $builder
    ){
        $this->builder = $builder;
    }

    /**
     * Send the method to the needed class
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        $probClass = "\\SaleBoss\\Services\\Menu\\CustomBuilders\\" . ucfirst(Str::camel($arguments[0]));
        if(class_exists($probClass)){
            $custom = App::make($probClass);
            return call_user_func_array([$custom,$method],$arguments);
        }
        return call_user_func_array(array($this->builder,$method),$arguments);
    }
}