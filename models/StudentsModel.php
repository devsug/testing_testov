<?php

namespace Models;

use Databases\MySqlDatabase;

class StudentsModel extends BaseModel
{
    /**
     * Отдает всех студентов по запросу
     *
     * @author Valery Shibaev
     * @version 1.0, 24.10.2023
     *
     * @return array
     */
    public function getStudents(): array
    {
        $connection = $this->getConnection(MySqlDatabase::class);
        if (!$connection) {
            return [];
        }

        return $connection->fetchAll('SELECT id, first_name, second_name, direction, birthday FROM students');
    }

    public function getStudent($id): array
    {
        $connection = $this->getMySQLConnection();
        if (!$connection) {
            return [];
        }

        $query = 'SELECT id, first_name, second_name, direction, birthday FROM students WHERE id = ' . $id;

        return $connection->getFirstData($query);
    }
}