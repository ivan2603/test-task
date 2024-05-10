<?php
use Components\Router;

//вивід помилок роботи фреймворку
ini_set('display_errors', 1);
error_reporting(E_ALL);

//підключення файлів системи
define('ROOT', dirname(__FILE__));
require_once (ROOT.'/vendor/autoload.php');

//виклик роутера
$router = new Router();
$router->run();