<?php

namespace Services;

use mysqli_result;
use mysqli;

/**
 * Класс для работы с БД mysql
 *
 * @author Valery Shibaev
 * @version 1.0, 08.10.2023
 */
class MySQLConnectionService
{
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;

        if ($this->connection instanceof mysqli) {
            mysqli_set_charset($this->connection, 'utf8');
        } else {
            trigger_error(mysqli_connect_error());
        }
    }

    /**
     * Отдает соединение БД
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $host Хостинг БД
     * @param string $user Пользователь
     * @param string $password Пароль пользователя
     * @param string $database БД
     * @return MySQLConnectionService
     */
    public static function getDataBaseService(
        string $host = 'localhost',
        string $user = 'root',
        string $password = '',
        string $database = 'livemaster.test'
    ): MySQLConnectionService
    {
        return new self(mysqli_connect($host, $user, $password, $database));
    }

    /**
     * Делает запрос в БД
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $query Запрос
     * @return bool|mysqli_result
     */
    private function getQuery(string $query)
    {
        return mysqli_query($this->connection, $query);
    }

    /**
     * Отдает множественные данные
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $query Запрос
     * @return array
     */
    public function getAllData(string $query): array
    {
        $result = $this->getResultOfQuery($query);
        if (!$result) {
            return [];
        }

        $resultData = [];
        while ($row = mysqli_fetch_array($result)) {
            $resultData[] = $row;
        }

        return $resultData;
    }

    /**
     * @param string $query
     * @return array
     */
    public function getFirstData(string $query): array
    {
        $result = $this->getResultOfQuery($query);
        if (!$result) {
            return [];
        }

        $resultData = [];
        while ($row = mysqli_fetch_array($result)) {
            $resultData = $row;
        }

        return $resultData;
    }

    /**
     * Отдает результат запроса
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param string $query
     * @return bool|mysqli_result
     */
    private function getResultOfQuery(string $query)
    {
        if (!$this->connection) {
            trigger_error(mysqli_connect_error());
            return false;
        }

        $result = $this->getQuery($query);
        if (!$result) {
            trigger_error(mysqli_error($this->connection));
            return false;
        }

        return $result;
    }
}