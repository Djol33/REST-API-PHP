<?php

namespace App\Router;
use ReflectionClass;

class Route
{

    public $route;
    private $method;
    private $objectToInvoke;
    private $protected;
    public function __construct($route, $method, $objectToInvoke, $protected=false) {
        $this->route = $route;
        $this->method= $method;
        $this->objectToInvoke = $objectToInvoke;
        $this->protected = $protected;

    }



    public function Create($params){

            $call = explode("@",$this->objectToInvoke);
            $object = $call[0];

            $call = $call[1];

                $page = new $object($params);
                return  $page->$call();







    }

    public function getMethod(){
        return $this->method;
    }

    public function isProtected(){
        return $this->protected;

    }
}