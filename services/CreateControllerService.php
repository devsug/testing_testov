<?php

namespace Services;

use Controllers\{
    BaseController,
    NotFoundController,
};
use Router;

/**
 * Класс, создающий контроллеры и отдающий контент по ним
 *
 * @author Valery Shibaev
 * @version 1.0, 08.10.2023
 */
class CreateControllerService
{
    /**
     * Отдает контроллер по роутеру
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param Router $router Объект роутера
     * @return BaseController|null
     */
    private function getControllerByRouter(Router $router): ?BaseController
    {
        if (!class_exists($router->controllerClass)) {
            return null;
        }

        $controller = new $router->controllerClass();
        if (!($controller instanceof BaseController)) {
            return null;
        }

        return $controller;
    }

    /**
     * Возвращает сформированые данные контроллера
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param Router|null $router
     * @return mixed
     */
    public function getMethodContent(?Router $router): mixed
    {
        if (!($router instanceof Router)) {
            return (new NotFoundController())->index();
        }

        $controller = $this->getControllerByRouter($router);
        if (!$controller) {
            return (new NotFoundController())->index();
        }

        if (!method_exists($controller, $router->method)) {
            return (new NotFoundController())->index();
        }

        return call_user_func([$controller, $router->method], $router->data);
    }

    /**
     * Отрисовывывает контент для контроллера
     *
     * @author Valery Shibaev
     * @version 1.0, 22.10.2023
     *
     * @param string|array $content Отдаваемый контент
     * @return void
     */
    public static function printContent(string|array $content): void
    {
        if (is_array($content)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($content);
            exit();
        }

        echo $content;
    }
}