<?php
require_once 'vendor/autoload.php';
require_once 'autoloader.php';

use Services\ControllerLoadService;

$pathLoader = new Twig\Loader\FilesystemLoader('views');
$doteEnv = \Dotenv\Dotenv::createImmutable(__DIR__);
$doteEnv->load();

global $twig;
session_start();

$twig = new \Twig\Environment($pathLoader);

$router = Router::getRouter($_SERVER['REQUEST_URI']);

$controllerLoadService = new ControllerLoadService();
$content = $controllerLoadService->getMethodContent($router);

printContent($content);

function printContent($content)
{
    if (is_array($content)) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($content);
        exit();
    }

    echo $content;
}