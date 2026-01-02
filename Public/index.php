<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Config/database.php';

$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerClass = 'App\\Controllers\\' . ucfirst($controllerName) . 'Controller';

$controller = new $controllerClass($pdo);
$controller->$action();
