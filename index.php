<?php
require_once 'vendor/autoload.php';
require_once 'autoloader.php';

use Services\CreateControllerService;
use Services\LoaderService;

session_start();

$loadService = new LoaderService;

$loadService->loadVendorCode();
$loadService->startupProjectConfig();

$router = Router::getRouter($_SERVER['REQUEST_URI']);

$content = (new CreateControllerService())->getMethodContent($router);
CreateControllerService::printContent($content);