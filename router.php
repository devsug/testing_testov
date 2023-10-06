<?php

use Controllers\{HomePageController, NotFoundController};

class Router
{
    public $controllerClass;
    public $method;

    const ROUTE_URLS = [
        '/' => [HomePageController::class, 'index'],
        '/student/{id}/{bebra}' => [HomePageController::class, 'getConcreteUser']
    ];

    public function __construct($uri)
    {
        $this->parseUriToSchema($uri);
        [$this->controllerClass, $this->method] = $this->parseUriToSchema($uri);
    }

    private function getMethodByUri(string $uri): array
    {
        return self::ROUTE_URLS[$uri] ?? [NotFoundController::class, 'index'];
    }

    private function parseUriToSchema(string $uri): array
    {
        if (!$uri) {
            return [NotFoundController::class, 'index'];
        }

        $routePatterns = array_keys(self::ROUTE_URLS);

        foreach ($routePatterns as $routePattern) {
            if (preg_match('/\{.*\}/ui', $routePattern)) {
                $explodedUri = array_filter(explode('/', $routePattern));
            }
        }

        return self::ROUTE_URLS[$uri];
    }

    public static function getRouter(string $uri): ?Router
    {
        if (!$uri) {
            return null;
        }

        return new self($uri);
    }

}