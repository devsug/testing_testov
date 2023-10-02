<?php

use Controllers\{HomePageController, NotFoundController};

class Router
{
    public $controllerClass;
    public $method;

    const ROUTE_URLS = [
        '/' => [HomePageController::class, 'index'],
    ];

    public function __construct($controllerClass, $method)
    {
        $this->controllerClass = $controllerClass;
        $this->method = $method;
    }

    private static function getMethodByUri(string $uri): array
    {
        return self::ROUTE_URLS[$uri] ?? [NotFoundController::class, 'index'];
    }

    public static function getRouter(string $uri): Router
    {
        return new self(...self::getMethodByUri($uri));
    }

}