<?php

namespace App\DTO\Request;

use App\Validator\GlobalValidator;
use App\Validator\Validator;

class UserAdd2DTO
{
    public $firstName;
    public $lastName;
    public $gender;
    public $yearOfBirth;
    public $address;
    public $city;


    public function __construct($params){
        $globalValidator = new GlobalValidator();
         $validateFName = new Validator(["firstName"=>$params["firstName"]]);
        $validateFName->message("First Name is Mandatory")->required()->
        message("Minimum lenght for first name is 3")->minLenght(3)
        ->message("First name must start with capital letter, without characters")->pattern("/^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,}$/u");

        $validateGender= new Validator(["gender"=>$params["gender"]]);
        $validateGender->message("gender is Mandatory")->required()
            ->message("Gender is not withing given range")->inRange(["M","Z"]);


        $validateLName= new Validator(["lastName"=>$params["lastName"]]);
        $validateLName->message("Last Name is Mandatory")->required()
            ->message("Minimum lenght for last name is 3")->minLenght(3)
        ->message("Last name must start with capital letter, without characters")->pattern("/^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,}$/u");


        $validateCity= new Validator(["city"=>$params["city"]]);
        $validateCity->message("City is Mandatory")->required()
            ->message("Minimum lenght for last name is 3")->minLenght(3)
            ->message("Enter proper city name")->pattern("/^\w{3,}(\s\w{3,})*$/u");

        $validateAdress = new Validator(["adress"=>$params["adress"]]);
        $validateAdress->message("Adress is Mandatory")->required()
            ->message("Minimum lenght for adress is 3")->minLenght(3)
            ->message("Enter proper Adress")->pattern("/^\w{3,}(\s\w{3,})*$/u");

        $validateToS = new Validator(["tos"=>$params["tos"]]);
        $validateToS->message("tos is required")->required()
            ->message("You Must agree to our tos")->pattern("/^checked$/");


        $validateYOB = new Validator(["yearOfBirth"=>$params["yearOfBirth"]]);
        $validateYOB->message("Year of birth is required")->required();

        $globalValidator->addValidator($validateToS,$validateYOB,$validateFName,
            $validateLName,$validateCity,$validateAdress,$validateGender);

        if($globalValidator->validate()){
            $this->firstName = $params['firstName']  ;
            $this->lastName  = $params['lastName']  ;
            $this->gender=$params['gender'];
            $this->city=$params['city'];
           $this->yearOfBirth=$params["yearOfBirth"];
           $this->address=$params["adress"];

        }
    }
}