<?php
require_once "Model/TaskModel.php";
require_once "View/ApiView.php";
require_once "Model/FolderModel.php";
class ApiTaskController{

    private $model;
    private $view;
    private $folderModel;


    function __construct(){
        $this->model = new TaskModel();
        $this->view = new ApiView();
        $this->folderModel= new FolderModel();
    }

    function getTasks(){   
        if (isset($_GET['id_folder'])){
            $idFolder=$_GET['id_folder'];
            $folder = $this->folderModel->getFolder($idFolder);
            if ($folder!=null){
                $tasks = $this->model->getTasksOfFolder($idFolder);
                return $this->view->response($tasks, 200); 
            }
            else{
                return $this->view->response("Id_folder=$idFolder doesn't exist", 404);
            }       
        }
        $tasks = $this->model->getTasks();
        return $this->view->response($tasks, 200);
    }

    function updateTask($params = null){
        $body = $this->getBody();
        $idTask = $params[":ID"];
        $task = $this->model->getTask($idTask);
        if ($task) {
            if (isset($body) && isset($body->description)){
                $this->model->updateTask($body->description,$idTask);
                return $this->view->response("Task was update successfully", 200);
            }else{
                if (isset($body) && isset($body->done)){
                    $this->model->changeTask($body->done,$idTask);
                    return $this->view->response("Task was update successfully", 200);
                }
            }
            return $this->view->response("Bad request", 400);
        }else {
            return $this->view->response("Id=$idTask doesn't exist", 404);
        }
    }
    function deleteTask($params = null){
        $idTask = $params[":ID"];
        $task = $this->model->getTask($idTask);
        if ($task) {
            $this->model->deleteTask($idTask);
            return $this->view->response("Id=$idTask was deleted", 200);
        } else {
            return $this->view->response("Id=$idTask doesn't exist", 404);
        }
    }

    function addTask(){
        // obtengo el body del request (json)
        $body = $this->getBody();
        if (isset($body) && isset($body->description) && isset($body->id_folder)){
            $folder= $this->folderModel->getFolder($body->id_folder);
            if ($folder){
                $idTask = $this->model->addTask($body->description,$body->id_folder,0);
                if ($idTask != null) {
                    return $this->view->response("Task was created with id=$idTask", 200);
                } else {
                    return $this->view->response("We can't do it", 500);
                }
            }
        }
        return $this->view->response("Bad request", 400);
    }

    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}