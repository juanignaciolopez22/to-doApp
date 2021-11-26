<?php

require_once "Model/UserModel.php";
require_once "View/UserView.php";

class UserController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    function showLogin()
    {
        $this->logout();
        $this->view->showFormLogin();
    }

    function verifyLogin()
    {   
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $mail = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->model->getUser($mail);
            if (($user) && password_verify($password, $user->password)) {
                session_start();
                $_SESSION["mail"] = $mail;
                header("Location: " . BASE_URL . "todolist");
            } else {
                if (!$user) {
                    $this->view->showFormLogin(true, false, $mail, $password); //user fail
                } else {
                    $this->view->showFormLogin(false, true, $mail, $password); //password fail
                }
            }
        }else{
            header("Location: " . BASE_URL . "home");
            die;
        }
    }
    
    function showApp(){
        session_start();
        if (!isset($_SESSION["mail"])){
            header("Location: " . BASE_URL . "home");
            die;
        }
        $this->view->showApp();
    }
    
    
    function logout()
    {
        session_start();
        session_destroy();
    }

}
