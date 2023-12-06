<?php

namespace DataBases;

/**
 * Интерфейс для соединения с БД
 *
 * @author Valery Shibaev
 * @version 1.0, 24.10.2023
 */
interface DatabaseConnection
{
    /**
     * Отдает сушность базы данных
     *
     * @param string $dataBase
     * @return DatabaseConnection|null
     */
    public static function getInstance(string $dataBase): ?self;
}