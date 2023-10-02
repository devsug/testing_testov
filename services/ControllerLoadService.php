<?php

namespace Services;

use Controllers\{
    BaseController,
    NotFoundController,
};
use Router;

class ControllerLoadService
{
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

    public function getMethodContent(Router $router)
    {
        $controller = $this->getControllerByRouter($router);
        if (!$controller) {
            return (new NotFoundController())->index();
        }

        if (!method_exists($controller, $router->method)) {
            return (new NotFoundController())->index();
        }

        return call_user_func([$controller, $router->method]);
    }
}