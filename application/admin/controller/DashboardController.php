<?php

namespace admin\controller;

use library\ParentController;

class DashboardController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        $data = $this->model->getDashboardData();
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'dashboard' . DS . 'index', $data);
    }
}
