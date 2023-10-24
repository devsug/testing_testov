<?php

namespace Models;

use Databases\DatabaseConnection;

/**
 * Базовая модель для работы с БД
 *
 * @author Valery Shibaev
 * @version 1.0, 24.10.2023
 */
class BaseModel
{
    /**
     * Отдает соединение с БД
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @param string $class Класс соединения к БД
     * @param string $dataBase База данных
     * @return DatabaseConnection|false
     */
    protected function getConnection(string $class, string $dataBase = 'livemaster.test'): DatabaseConnection|false
    {
        if (!class_exists($class) || !$dataBase) {
            return false;
        }

        if (!method_exists($class, 'getInstance')) {
            return false;
        }

        return $class::getInstance($dataBase);
    }
}