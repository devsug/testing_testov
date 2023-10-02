<?php

namespace Services;

class MySQLConnectionService
{
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;

        if ($this->connection instanceof \mysqli) {
            mysqli_set_charset($this->connection, 'utf8');
        } else {
            trigger_error(mysqli_connect_error());
        }
    }

    public static function getDataBaseService(
        $host = 'localhost',
        $user = 'root',
        $password = '',
        $database = 'livemaster.test'
    ): MySQLConnectionService
    {
        return new self(mysqli_connect($host, $user, $password, $database));
    }

    private function getQuery(string $query)
    {
        return mysqli_query($this->connection, $query);
    }

    public function getDataForQuery($query): array
    {
        if (!$this->connection) {
            trigger_error(mysqli_connect_error());
            return [];
        }

        $result = $this->getQuery($query);
        if (!$result) {
            trigger_error(mysqli_error($this->connection));
            return [];
        }

        $resultData = [];
        while ($row = mysqli_fetch_array($result)) {
            $resultData[] = $row;
        }

        return $resultData;
    }
}