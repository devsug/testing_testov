<?php

namespace Models;

use Services\MySQLConnectionService;

class BaseModel
{
    public function getMySQLConnection($host = 'localhost', $user = 'root', $password = '', $database = 'livemaster.test')
    {
        return MySQLConnectionService::getDataBaseService($host, $user, $password, $database);
    }
}