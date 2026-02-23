<?php

require_once __DIR__ . '/vendor/autoload.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
use App\Router\Router;
use App\Controller\Controller;
use App\Router\Route;
use App\Controller\UserController;
use App\Controller\ValidateDataControler;
use App\ENV;
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
$router  = new Router();


$router->Add( new Route('/orders', "GET", Controller::class . "@GET")) ;
$router->Add(new Route("/user", "POST", UserController::class."@POST",true));
$router->Add(new Route('/validate',"POST",ValidateDataControler::class."@POST" ));



 $router->dispatch();

