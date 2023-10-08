<?php

use Controllers\{HomePageController, NotFoundController};

class Router
{
    /** @var string Класс контроллера, который мы создаем */
    public $controllerClass;
    /** @var string Вызываемый метод */
    public $method;
    /** @var array|string  */
    public $data = [];

    /** Регулярное выражение, которое мы должны заменять */
    const VAR_PATTERN = '/\{.*\}/ui';
    /** Регулярное выражение, на которое мы должны заменять: все доступные значения */
    const URI_REPLACEMENT_ALL = '([A-Za-z0-9].*)';
    /** Маршруты для проверки */
    const ROUTE_URLS = [
        '/' => [HomePageController::class, 'index'],
        '/student/{id}/' => [HomePageController::class, 'getConcreteUser']
    ];

    /**
     * Конструктор класса
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $uri Проверяемый URI
     */
    public function __construct(string $uri)
    {
        $parsedUri = $this->parseUriToSchema($uri);
        [$this->controllerClass, $this->method] = $parsedUri;
        if ($parsedUri['data']) {
            $this->data = $parsedUri['data'];
        }
    }

    /**
     * По передаваемомум uri сравнивает с роутером и парсит в переменные параметры
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $uri Проверяемый URI
     * @return array
     */
    private function parseUriToSchema(string $uri): array
    {
        if (!$uri) {
            return [NotFoundController::class, 'index'];
        }

        foreach (self::ROUTE_URLS as $routePattern => $controllerData) {
            $explodedUri = explode('/', $routePattern);

            $parsedExplodedUri = $this->getParsedExplodedUri($routePattern, (array) $explodedUri);

            $parsedUri = implode('\/', $parsedExplodedUri ?: $explodedUri);
            $parsedUri = '/' . $parsedUri . '/ui';

            if (preg_match($parsedUri, $uri) && !preg_filter($parsedUri, '', $uri)) {
                $varsFromUri = $this->getVarsFromUri($routePattern, $uri);

                return array_merge($controllerData, ['data' => $varsFromUri]);
            }
        }

        return [NotFoundController::class, 'index'];
    }

    /**
     * Отдает роутер по URI
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $uri Проверяемый URI
     * @return Router|null
     */
    public static function getRouter(string $uri): ?Router
    {
        if (!$uri) {
            return null;
        }

        return new self($uri);
    }

    /**
     * Заменяет переменные в ссылке на регулярные выражения
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $routePattern Паттерн по которому проверяем подходит ли URI
     * @param array $explodedUri Ссылка разбитая на массив
     * @return array
     */
    protected function getParsedExplodedUri(string $routePattern, array $explodedUri): array
    {
        if (!$explodedUri) {
            return [];
        }

        $parsedExplodedUri = [];

        if (preg_match(self::VAR_PATTERN, $routePattern)) {
            foreach ($explodedUri as $elem) {
                if (preg_match(self::VAR_PATTERN, $elem)) {
                    $elem = preg_filter(self::VAR_PATTERN, self::URI_REPLACEMENT_ALL, $elem);
                }

                $parsedExplodedUri[] = $elem;
            }
        }

        return $parsedExplodedUri;
    }

    /**
     * Формирует данные из переменных
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $routePattern Паттерн, по которому мы сравниваем URI
     * @param string $uri Проверяемый URI
     * @return array
     */
    protected function getVarsFromUri(string $routePattern, string $uri): array
    {
        $varKeys = array_diff(explode('/', $routePattern), explode('/', $uri));
        $varsFromUri = [];

        foreach ($varKeys as $index => $key) {
            $clearedKey = str_replace('}', '', str_replace('{', '', $key));
            $varsFromUri[$clearedKey] = explode('/', $uri)[$index];
        }

        return $varsFromUri;
    }

}