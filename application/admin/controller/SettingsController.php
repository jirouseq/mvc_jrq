<?php

namespace admin\controller;

use library\ParentController;

class SettingsController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'settings' . DS . 'index', []);
    }
}
