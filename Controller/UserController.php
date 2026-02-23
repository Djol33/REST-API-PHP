<?php

namespace App\Controller;
use App\DTO\Request\UserAddDTO;
use App\Model\UserAdd;
use App\Exception\CustomException;
class UserController implements  IController
{
    private $params;
    public function __construct($params){

        $this->params = $params;


    }
    public function GETone(){


    }
    public function GET()
    {
        // TODO: Implement GET() method.
    }

    public function POST( )
    {

         $params = new UserAddDTO($this->params);
         $db = new UserAdd($params);
         $db->Execute();


    }

    public function PUT()
    {
        // TODO: Implement PUT() method.
    }

    public function DELETE()
    {
        // TODO: Implement DELETE() method.
    }
}