<?php

namespace DataBases;

/**
 * Интерфейс для изменений в БД (удаление, добавление, обновление)
 *
 * @author Valery Shibaev
 * @version 1.0, 24.10.2023
 */
interface DatabaseChanges
{
    /**
     * Метод для обновлений данных в БД
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @param string $query Запрос
     * @return bool
     */
    public function changeQuery(string $query): bool;
}