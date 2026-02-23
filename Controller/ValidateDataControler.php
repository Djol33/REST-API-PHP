<?php

namespace App\Controller;

use App\DTO\Request\UserAdd2DTO;
use App\Response\Response;

class ValidateDataControler implements IController
{

    private $params;
    public function __construct($params)
    {
$this->params = $params;
    }


    public function GETONE()
    {
        // TODO: Implement GETONE() method.
    }

    public function GET()
    {
        // TODO: Implement GET() method.
    }

    public function POST()
    {
         $clientData = new UserAdd2DTO($this->params);
         
        return $clientData;

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