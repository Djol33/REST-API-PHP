<?php
namespace App\Controller;
use App\Model\SelectAllOrdersModel;
class Controller implements IController
{
    private $params = [];
    public function __construct($params= []){
       $this->params = $params;

        }

    public function GET()
    {

        $model = new SelectAllOrdersModel();
        http_response_code(200);
        return  ($model->Execute());
    }
    public function GETONE()
    {

        return ($this->params);
    }

    public function POST(   )
    {
        // TODO: Implement POST() method.
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