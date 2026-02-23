<?php

namespace App\DTO\Request;
use App\Validator\Validator;
use App\DTO\Request\DTO;
use App\Exception\CustomException;
use App\Validator\GlobalValidator;
class UserAddDTO implements DTO
{

    public $firstname;
    public $lastname;
    public $phone;
    public $email;

    public function __construct($params)
    {
        $globalValidator = new GlobalValidator();

        $validateFName = new Validator(["First Name"=>$params["firstname"]]);
        $validateFName->message("First Name is Mandatory")->required()->message("Minimum lenght for first name is 3")->minLenght(3);

        $validatePhone= new Validator(["Phone"=>$params["phone"]]);
        $validatePhone->message("Phone is Mandatory")->required()
           ->message("Minimum lenght for phone is 9")->minLenght(9);


        $validateLName= new Validator(["Last Name"=>$params["lastname"]]);
        $validateLName->message("Last Name is Mandatory")->required()
            ->message("Minimum lenght for last name is 3")->minLenght(3);

        $validateEmail = new Validator(["Email"=>$params["email"]]);
        $validateEmail->message("Email is requiered")->required()
            ->message("Enter a proper email")->email();
        $globalValidator->addValidator($validateFName,$validatePhone,$validateLName,$validateEmail);

        if($globalValidator->validate()){
            $this->firstname = $params['firstname']  ;
            $this->lastname  = $params['lastname']  ;
            $this->phone     = $params['phone']  ;
            $this->email     = $params['email'];
        }

    }
    public function Validate(){


    }


}