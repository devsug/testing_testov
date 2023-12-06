<?php

namespace Services;

use Twig;
use Dotenv\Dotenv;

/**
 * Класс для загрузки и первоначальной настройки библиотек
 *
 * @author Valery Shibaev
 * @version 1.0, 22.10.2023
 */
class LoaderService
{
    /**
     * Загружает и настраивает сторонние библиотеки
     *
     * @author Valery Shibaev
     * @version 1.0, 22.10.2023
     *
     * @return $this;
     */
    public function loadVendorCode(): self
    {
        $this->loadTwig();
        $this->loadDotEnv();
        return $this;
    }

    /**
     * Загружает и настраивает шаблонизатор Twig
     *
     * @author Valery Shibaev
     * @version 1.0, 22.10.2023
     *
     * @return void
     */
    private function loadTwig(): void
    {
        global $twig;
        $twig = new Twig\Environment(new Twig\Loader\FilesystemLoader('views'));
    }

    /**
     * Загружает и настраивает библиотеку для переменных окружения dotenv
     *
     * @author Valery Shibaev
     * @version 1.0, 22.10.2023
     *
     * @return void
     */
    private function loadDotEnv(): void
    {
        Dotenv::createImmutable(__DIR__ . '/../')->load();
    }

    /**
     * Настройки проекта
     *
     * @author Valery Shibaev
     * @version 1.0, 23.10.2023
     *
     * @return $this;
     */
    public function startupProjectConfig(): self
    {
        ini_set('display_errors', $_ENV['ERROR_REPORTING']);
        ini_set('display_startup_errors', $_ENV['ERROR_REPORTING']);
        error_reporting(E_ERROR);
        return $this;
    }
}