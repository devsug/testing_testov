<?php

use Controllers\{HomePageController, NotFoundController};

class Router
{
    public $controllerClass;
    public $method;

    const VAR_PATTERN = '/\{.*\}/ui';
    const URI_REPLACEMENT_ALL = '([A-Za-z0-9].*)';
    const ROUTE_URLS = [
        '/' => [HomePageController::class, 'index'],
        '/student/{id}/{bebra}' => [HomePageController::class, 'getConcreteUser']
    ];

    public function __construct($uri)
    {
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

        foreach (self::ROUTE_URLS as $routePattern => $data) {
            $parsedExplodedUri = [];
            $explodedUri = explode('/', $routePattern);
            $varKeys = [];

            if (preg_match(self::VAR_PATTERN, $routePattern)) {
                foreach ($explodedUri as $elem) {
                    if (preg_match(self::VAR_PATTERN, $elem)) {
                        $elem = preg_filter(self::VAR_PATTERN, self::URI_REPLACEMENT_ALL, $elem);
                    }

                    $parsedExplodedUri[] = $elem;
                }
            }

            $parsedUri = implode('\/', $parsedExplodedUri);
            $parsedUri = '/' . $parsedUri . '/ui';
            if (preg_match($parsedUri, $uri) && !preg_filter($parsedUri, '', $uri)) {
                $varKeys = array_diff(explode('/', $routePattern), explode('/', $uri));
                $varsFromUri = [];

                foreach ($varKeys as $index => $key) {
                    $a = str_replace('}', '', str_replace('{', '', $key));
                    $varsFromUri[$a] = explode('/', $uri)[$index];
                }

                return $data;
            }
        }

        return [NotFoundController::class, 'index'];
    }

    public static function getRouter(string $uri): ?Router
    {
        if (!$uri) {
            return null;
        }

        return new self($uri);
    }

}