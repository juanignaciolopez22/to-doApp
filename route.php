<?php

require_once "Controller/UserController.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

$userController = new UserController();

switch ($params[0]) {
    case 'home':
        $userController->showLogin();
    break;
    case 'verifylogin':
        $userController->verifylogin();
    break;
    case 'todolist':
        $userController->showApp();
    break;

}
