<?php

namespace Controllers;

/**
 * Базовый контроллер
 *
 * @author Valery Shibaev
 * @version 1.0, 23.10.2023
 */
class BaseController
{
    /**
     * Отрисовывает шаблон twig
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $viewPath Путь до шаблоны
     * @param array $data Данные, которые надо передать в шаблон
     * @return string
     */
    public function getView(string $viewPath = '', array $data = []): string
    {
        if (!$viewPath) {
            return '';
        }
        global $twig;

        return $twig->render($viewPath, $data);
    }

    /**
     * Метод редиректа на 404
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @return string
     */
    public function redirectToNotFound(): string
    {
        return (new NotFoundController())->index();
    }
}