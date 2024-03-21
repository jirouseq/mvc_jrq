<?php

namespace home\controller;

use library\ParentController;

class HomepageController extends ParentController
{

    /**
     * method index
     */

    public function index()
    {
        $data = $this->model->getHomepage();
        $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'homepage' . DS . 'index', $data);
    }
}
