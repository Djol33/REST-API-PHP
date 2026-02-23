<?php

namespace App\Exception;
use Exception;

class CustomException extends Exception
{
    private $error;

    public function __construct($errors, $code)
    {



        if(is_array($errors)){
            foreach ($errors as &$e){
                $e = implode(", ",$e);
            }


        $this->error=$errors;

    }else {
            $this->error=$errors;
        }


        parent::__construct("Greska u validaciji", $code);
    }

    public function  getError(){
        return $this->error;
    }
}