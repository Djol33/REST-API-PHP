<?php

namespace App\Model;

use PDO;

class DB
{

    private $host = 'localhost';
    private $dbname = 'nbsoft';
    private $username = 'root';
    private $password = '';
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );

        } catch
        (PDOException $e) {
            die("Greška pri povezivanju: " . $e->getMessage());
        }
    }

}