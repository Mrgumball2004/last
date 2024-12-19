<?php

include 'dbconnect.class.php';

class Client
{
    private $cnx;

    public function __construct()
    {
        $db = new BasesDonnees;
        $this->cnx = $db->connectDB();
    }

    public function verifExist($email)
    {
        $req = 'SELECT * FROM clients WHERE email= :email';
        $result = $this->cnx->prepare($req);
        $result->bindParam(':email', $email);
        if($result->execute()){
            return $result;
        }else{
            return null;
        }
    }

    public function addNewClient($name, $email, $password, $phone, $address, $img)
    {
        $sql = "INSERT INTO clients(name, email, pwd, phonenumber, adresse, img) 
                VALUES (:name, :email, :password, :phone, :address, :img)";
        $result = $this->cnx->prepare($sql);
        $result->bindparam(":name", $name);
        $result->bindparam(":email", $email);
        $result->bindparam(":password", $password);
        $result->bindparam(":phone", $phone);
        $result->bindparam(":address", $address);
        $result->bindparam(":img", $img);
        if($result->execute()){
            return $result;
        }else{
            return null;
        }
    }

    public function number_of_clients()
    {
        $req = 'SELECT count(*) as clients FROM clients';
        $result = $this->cnx->prepare($req);
        $result->execute();
        return $result;
    }

    public function getAllClients()
    {
        $req = 'SELECT * FROM clients';
        $result = $this->cnx->prepare($req);
        $result->execute();
        return $result;
    }

    public function getOneClient($id)
    {
        $req = 'SELECT * FROM clients WHERE id = :id';
        $result = $this->cnx->prepare($req);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result;
    }

    public function updateClient($id, $name, $email, $password, $phone, $address, $img)
    {
        $sql = 'UPDATE clients 
                SET name = :name, 
                    email = :email, 
                    pwd = :password, 
                    phonenumber = :phone, 
                    adresse = :address, 
                    img = :img 
                WHERE id = :id';
        $result = $this->cnx->prepare($sql);
        $result->bindparam(":name", $name);
        $result->bindparam(":email", $email);
        $result->bindparam(":password", $password);
        $result->bindparam(":phone", $phone);
        $result->bindparam(":address", $address);
        $result->bindparam(":img", $img);
        $result->bindparam(":id", $id);
        if($result->execute()){
            return $result;
        }else{
            return null;
        }
    }

    public function deleteClient($id)
    {
        $sql = 'DELETE FROM clients WHERE id = :id';
        $result = $this->cnx->prepare($sql);
        $result->bindparam(":id", $id);
        if($result->execute()){
            return $result;
        }else{
            return null;
        }
    }
}