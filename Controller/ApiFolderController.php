<?php

require_once "View/ApiView.php";
require_once "Model/FolderModel.php";
class ApiFolderController{

    private $model;
    private $view;


    function __construct(){
        $this->model = new FolderModel();
        $this->view = new ApiView();
    }

    function getFolders(){   
        $folders = $this->model->getFolders();
        return $this->view->response($folders, 200);
    }

    function deleteFolder($params = null){
        $idFolder = $params[":ID"];
        $folder = $this->model->getFolder($idFolder);
        if ($folder) {
            $this->model->deleteFolder($idFolder);
            return $this->view->response("Id=$idFolder was deleted", 200);
        } else {
            return $this->view->response("Id=$idFolder doesn't exist", 404);
        }
    }

    function addFolder(){
        // get body request
        $body = $this->getBody();
        if (isset($body) && isset($body->name)){
            $idFolder=$this->model->addFolder($body->name);
            if ($idFolder != null) {
                return $this->view->response("Folder was created with id=$idFolder", 200);
            } else {
                return $this->view->response("We can't add it", 500);
            }
        }
        else{
            return $this->view->response("Bad request", 400); 
        }
    }

    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}