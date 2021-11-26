<?php
class UserModel
{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=to-doApp;charset=utf8', 'root', '');
    }

    function getUser($mail)
    {
        $sentencia = $this->db->prepare("SELECT * FROM users WHERE mail=?");
        $sentencia->execute(array($mail));
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        return $user;
    }

}
