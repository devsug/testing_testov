<?php

namespace Controllers;

class BaseController
{
    public function getView($viewPath = '', $data = []): string
    {
        if (!$viewPath) {
            return '';
        }
        global $twig;

        return $twig->render($viewPath, $data);
    }
}