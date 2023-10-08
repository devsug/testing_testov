<?php

namespace Controllers;

use Models\StudentsModel;

class HomePageController extends BaseController
{
    public function index(): string
    {
        $model = new StudentsModel();
        $resultData = $model->getStudents();

        return $this->getView('homepage.twig', ['students' => $resultData]);
    }

    /**
     * Отдает конкретного пользователя
     *
     * @author Valery Shibaev
     * @version 1.0, 08.10.2023
     *
     * @param array $data Приходящие данные из uri
     * @return string
     */
    public function getConcreteUser(array $data): string
    {
        $id = (int) $data['id'];
        if (!$id) {
            return $this->redirectToNotFound();
        }

        $studentModel = new StudentsModel();
        $resultData = $studentModel->getStudent($id);

        if (!$resultData) {
            return $this->redirectToNotFound();
        }

        return $this->getView('student.twig', ['student' => $resultData]);
    }
}