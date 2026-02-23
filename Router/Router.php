<?php

namespace App\Router;
use App\ENV;
use App\Exception\CustomException;
use App\Response\Response;
use App\Exception\Exception;
class Router
{
    public static   $array =[];
    public function dispatch(){
        foreach (self::$array as $item){
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = rtrim($uri,"/");
            $route = $item->route;
            (preg_match_all('#\{([^}]+)\}#', $route, $paramNames));
            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route);


            $pattern = "#^/" . ltrim($pattern, '/') . "$#";

            preg_match( $pattern , $uri, $matches);

            if(preg_match( $pattern  ,$uri) && ($item->getMethod() == $_SERVER["REQUEST_METHOD"])) {


                    try{



                        if($item->isProtected()) {
                            if(!$this->Guard()) throw new CustomException("Route is protected",403 );;
                        }

                        $params = [];

                        foreach ($paramNames[1] as $index => $name) {

                            if (isset($matches[$index + 1])) {

                                $params[$name] = $matches[$index + 1];
                            }

                        }
                        if(!in_array($_SERVER['REQUEST_METHOD'], ["POST", "PUT", "PATCH"])){
                      echo json_encode(new Response($item->Create($params)));
                        }
                        else{
                            $json = file_get_contents('php://input');


                            $data = json_decode($json, true);
                             echo json_encode(new Response($item->Create($data)));


                        }
                    }
                    catch(\Throwable $e){
                         new Exception($e);
                    }

            return;
            }

        }
    }

    public function Add(Route $item){

        array_push(self::$array, $item);
    }

    public function Guard(){
        $authHeader = null;
        foreach (getallheaders() as $key=>$value){

            if($key=="Authorization") $authHeader = $value;
        }
        return ENV::getValue("SECRET_KEY") == $authHeader;

    }

}