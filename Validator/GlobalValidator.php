<?php

namespace App\Validator;

use App\Exception\CustomException;

class GlobalValidator
{


    private $validator=[];
    private $errors=[];

    public function __construct()
    {
    }

    public function addValidator( ){
        $numargs = func_get_args();
        foreach($numargs as $item){
            if($item instanceof Validator){

                array_push($this->validator,$item);
            }

        }


    }

    public function validate(){
        if(count($this->validator)){
            foreach($this->validator as $val){
                if($a = $val->fails()){
                    $this->errors = array_merge($this->errors, $a);
                }
            }
       ;
         }

        if(count($this->errors)) throw new CustomException($this->errors, 422);

        return true;

    }


}