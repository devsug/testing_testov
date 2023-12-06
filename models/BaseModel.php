<?php

namespace Models;

use DataBases\DataBaseDefault;
use Exception;

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
     * @return DataBaseDefault
     * @throws
     */
    protected function getConnection(string $class, string $dataBase): DataBaseDefault
    {
        if (!class_exists($class) || !$dataBase) {
            throw new Exception('Ошибка в подключении бд: такого класса не существует или такой базы данных нет');
        }

        return $class::getInstance($dataBase);
    }
}