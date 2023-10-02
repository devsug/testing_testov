<?php

namespace Models;

class HomePageModel extends BaseModel
{
    public function getStudents(): array
    {
        $connection = $this->getMySQLConnection();
        if (!$connection) {
            return [];
        }

        $query = 'SELECT id, first_name, second_name, direction, birthday, personal_file_link FROM students';

        return $connection->getDataForQuery($query);
    }
}