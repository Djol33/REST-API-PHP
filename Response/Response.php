<?php
namespace App\Response;
class Response
{
    public $success;
    public $message;
    public $statusCode;

    public function  __construct( $message,  $success=true){
        $this->success=$success;
        $this->statusCode=http_response_code();
        $this->message=$message;
    }
}