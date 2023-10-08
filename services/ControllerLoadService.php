<?php

namespace Services;

use Controllers\{
    BaseController,
    NotFoundController,
};
use Router;

/**
 * Класс, отдающий контроллеры
 * @author Valery Shibaev
 * @version 1.0, 08.10.2023
 */
class ControllerLoadService
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
     * @return mixed|string
     */
    public function getMethodContent(?Router $router)
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
}