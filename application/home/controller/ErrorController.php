<?php

namespace home\controller;

use library\ParentController;

class ErrorController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        //echo 'error';
    }

    /**
     * method permission
     */

    public function permission(): void
    {
        $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'error' . DS . 'permission', []);
    }
}
