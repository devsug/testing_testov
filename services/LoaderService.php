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
     * @return void
     */
    public function loadVendorCode(): void
    {
        $this->loadTwig();
        $this->loadDotEnv();
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
}