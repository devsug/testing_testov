<?php

namespace Controllers;

use Models\HomePageModel;

class HomePageController extends BaseController
{
    public function index(): string
    {
        $model = new HomePageModel();
        $resultData = $model->getStudents();

        return $this->getView('homepage.twig', ['students' => $resultData]);
    }
}