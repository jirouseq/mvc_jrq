<?php

namespace home\controller;

use library\ParentController;

class ForgottenPasswordController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'forgottenPassword' . DS . 'index', []);
    }

    /**
     * method sendToken
     */

    public function sendToken(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->processSendToken($_POST);
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'forgottenPassword' . DS . 'send-token', []);
        } else {
            $this->index();
        }
    }

    /**
     * method reset
     * @param array from click link from email
     */

    public function reset(array $token): void
    {
        $data = $this->model->processReset($token[0]);
        if (is_array($data)) {
            if ($data['status']) {
                $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'forgottenPassword' . DS . 'form', $data);
            } else {
                $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'forgottenPassword' . DS . 'expirated', []);
            }
        }
    }

    /**
     * method restore
     */

    public function restore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->model->processRestore($_POST);
            if ($data['status']) {
                $this->response($data);
            }
        }
    }
}
