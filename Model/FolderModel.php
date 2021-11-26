<?php
class FolderModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=to-doApp;charset=utf8', 'root', '');
    }
    function getFolders()
    {
        $sentencia = $this->db->prepare("SELECT * FROM folders");
        $sentencia->execute();
        $folders = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $folders;
    }
    function getFolder($id_folder){
        $sentencia = $this->db->prepare("SELECT * FROM folders WHERE id=?");
        $sentencia->execute(array($id_folder));
        $folder = $sentencia->fetch(PDO::FETCH_OBJ);
        return $folder;
    }
    function deleteFolder($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM folders WHERE id=?");
        $sentencia->execute(array($id));
    }
    function addFolder($name)
    {
        $sentencia = $this->db->prepare("INSERT INTO folders(name) VALUES(?)");
        $sentencia->execute(array($name));
        return $this->db->lastInsertId();
    }

}