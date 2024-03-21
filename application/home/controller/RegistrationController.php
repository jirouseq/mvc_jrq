<?php

namespace home\controller;

use library\ParentController;

class RegistrationController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        if ($this->model->userExist()) {
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'registration' . DS . 'is-loged', []);
        } else {
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'registration' . DS . 'index', []);
        }
    }

    /**
     * method add
     */

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->response($this->model->setUser($_POST));
        }
    }

    /**
     * method controlEmail
     * @param array email
     */

    public function controlEmail(array $email): void
    {
        $response = $this->model->emailExist($email['email']);
        $this->response($response);
    }
}
