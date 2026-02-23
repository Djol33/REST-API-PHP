<?php
namespace App\Exception;

use App\ENV;
use App\Response\Response;
use ReflectionClass;

class Exception
{
    private $exceptions = [
        'PDOException' => [
            '23000' => [
                1062 => ['message' => 'Podatak već postoji.', 'status' => 409],
                1451 => ['message' => 'Brisanje nije dozvoljeno jer je podatak povezan.', 'status' => 400],
                1452 => ['message' => 'Povezani podatak ne postoji.', 'status' => 400],
                123123=>['message'=>"Email is already in use", 'status'=>'400']
            ],
            '42S02' => ['message' => 'Sistemska greška u bazi.', 'status' => 500],
            '08006' => ['message' => 'Veza sa bazom prekinuta.', 'status' => 503],
        ],
        'TypeError' => ['message' => 'Pogrešan format podataka.', 'status' => 422],
        'ArgumentCountError' => ['message' => 'Nedostaju obavezni parametri.', 'status' => 400],
        'Default' => ['message' => 'Došlo je do neočekivane greške.', 'status' => 500],
        'CustomException' => [

            422 =>[]
    ]
];

    public function __construct($e)
    {

        $type = (new ReflectionClass($e))->getShortName();

        $isDev=true;
        $result = $this->exceptions['Default'];

        if (isset($this->exceptions[$type])) {
            $map = $this->exceptions[$type];
             if ($type === 'PDOException') {
                $sqlState = $e->errorInfo[0] ?? null;
                $mysqlCode = $e->errorInfo[1] ?? null;

                if (isset($map[$sqlState])) {
                    $result = is_array($map[$sqlState])
                        ? ($map[$sqlState][$mysqlCode] ?? $result)
                        : $map[$sqlState];
                }
            } else if($type=="CustomException") {


                     $result["message"] = $e->getError();
                     $result["status"]= $e->getCode();


            }else{
                 $result = $this->exceptions[$type];
             }
        }
       if (ENV::getBool("IS_DEV")) {
            $result['message'] = [
                'info' => $result['message'],
                'error_detail' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
        }
        $this->terminate($result);
    }

    private function terminate(array $data)
    {

        http_response_code($data['status']);
        echo json_encode(new Response($data['message'], false));
        exit;
    }
}