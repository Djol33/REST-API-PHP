<?php

namespace App\Model;

class UserAdd extends DB implements IModel
{
    protected $User;

    public function __construct($User)
    {
        parent::__construct();
        $this->User = $User;

    }

    public function Execute()
    {
            $sql = "INSERT INTO user (firstname, lastname, phone, email ) 
        VALUES (:firstname, :lastname, :phone, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":firstname", $this->User->firstname);
        $stmt->bindParam(":lastname", $this->User->lastname);
        $stmt->bindParam(":phone", $this->User->phone);
        $stmt->bindParam(":email", $this->User->email);

        $stmt->execute();

    }
}