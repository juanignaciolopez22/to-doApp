<?php
class TaskModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=to-doApp;charset=utf8', 'root', '');
    }
    function getTasks()
    {
        $sentencia = $this->db->prepare("SELECT * FROM tasks");
        $sentencia->execute();
        $tasks = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }
    function getTasksOfFolder($id_folder){
        $sentencia = $this->db->prepare("SELECT * FROM tasks WHERE id_folder=?");
        $sentencia->execute(array($id_folder));
        $tasks = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }
    function getTask($id){
        $sentencia = $this->db->prepare("SELECT * FROM tasks WHERE id=?");
        $sentencia->execute(array($id));
        $task = $sentencia->fetch(PDO::FETCH_OBJ);
        return $task;
    }
    function deleteTask($id){
        $sentencia = $this->db->prepare("DELETE FROM tasks WHERE id=?");
        $sentencia->execute(array($id));
    }

    function addTask($description, $id_folder, $done)
    {
        $sentencia = $this->db->prepare("INSERT INTO tasks(description, id_folder,done) VALUES(?, ?, ?)");
        $sentencia->execute(array($description, $id_folder, $done));
        return $this->db->lastInsertId();
    }
    function updateTask($description,$id){
        $sentencia = $this->db->prepare("UPDATE tasks SET description=? WHERE id=?");
        $sentencia->execute(array($description,$id));
    }
    function changeTask($done,$id){
        $sentencia = $this->db->prepare("UPDATE tasks SET done=? WHERE id=?");
        $sentencia->execute(array($done,$id));
    }
}