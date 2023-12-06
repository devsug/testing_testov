<?php

namespace Models;

use DataBases\MySqlDatabase;

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
        $connection = $this->getConnection(MySqlDatabase::class, 'livemaster.test');

        return $connection->fetchAll('SELECT id, first_name, second_name, direction, birthday FROM students');
    }

    /**
     * Отдает одного студента
     *
     * @author Valery Shibaev
     * @version 1.0, 25.10.2023
     *
     * @param int $id Идентификатор студента
     * @return array
     */
    public function getStudent(int $id): array
    {
        $connection = $this->getConnection(MySqlDatabase::class, 'livemaster.test');
        $query = 'SELECT id, first_name, second_name, direction, birthday FROM students WHERE id = ' . $id;

        return $connection->fetchFirstItem($query);
    }
}