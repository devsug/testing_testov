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

    public function getConcreteUser($data): string
    {
        $id = (int) $data['id'];
        if (!$id) {
            return '';
        }

        $studentModel = new StudentsModel();
        $resultData = $studentModel->getStudent($id);

        return $this->getView('student.twig', ['student' => $resultData]);
    }
}