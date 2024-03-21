<?php

namespace home\controller;

use library\ParentController;

class ContactFormController extends ParentController
{

    /**
     * methd index
     */

    public function index(): void
    {
        $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'contact' . DS . 'index', []);
    }

    /**
     * methd send form
     * async response data
     */

    public function sendForm(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->response($this->model->processSendForm($_POST));
        }
    }
}
