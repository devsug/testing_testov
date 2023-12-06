<?php

namespace DataBases;

/**
 * Интерфейс с методами доступа к данным в БД
 *
 * @author Valery Shibaev
 * @version 1.0, 24.10.2023
 */
interface DatabaseFetches
{
    /**
     * Отдает все данные по запросу
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @param string $query Запрос
     * @return array
     */
    public function fetchAll(string $query): array;

    /**
     * Отдает первую строку запроса
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @param string $query Запрос
     * @return array
     */
    public function fetchFirstItem(string $query): array;

    /**
     * Отдает колонку по запросу
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @param string $query Запрос
     * @return array
     */
    public function fetchFirstColumn(string $query): array;
}