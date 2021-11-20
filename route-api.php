<?php

require_once 'libs/Router.php';
require_once 'Controller/ApiTaskController.php';
require_once 'Controller/ApiFolderController.php';

$router = new Router();

// endpoints
$router->addRoute('tasks','GET', 'ApiTaskController', 'getTasks');
$router->addRoute('tasks/:ID', 'DELETE', 'ApiTaskController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'ApiTaskController', 'addTask');
$router->addRoute('tasks/:ID','PUT', 'ApiTaskController', 'updateTask');
$router->addRoute('folders','GET', 'ApiFolderController', 'getFolders');
$router->addRoute('folders/:ID', 'DELETE', 'ApiFolderController', 'deleteFolder');
$router->addRoute('folders', 'POST', 'ApiFolderController', 'addFolder');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);