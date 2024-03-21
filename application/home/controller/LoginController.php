<?php

namespace home\controller;

use DI\Container;
use library\ParentController;
use library\Redir;

class LoginController extends ParentController
{
    private $redir;

    /**
     * method construct
     * @param class Container
     * @param class redir
     */

    public function __construct(Container $container, Redir $redir)
    {
        parent::__construct($container);
        $this->redir = $redir;
    }

    /**
     * method index
     * @param array user data from form
     */

    public function index($userData = null): void
    {
        if ($this->model->userExist()) {
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'login' . DS . 'is-loged', []);
        } else {
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'login' . DS . 'index', $userData);
        }
    }

    /**
     * method login
     */

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;
            $returnData = $this->model->processLogin($formData);
            if ($returnData['status']) {
                $this->redir->to($returnData['location']);
            } else {
                $this->index($returnData);
            }
        }
    }

    /**
     * method is loged
     * checking if the user is logged in for javascript
     */

    public function isLoged(): void
    {
        $this->response($this->model->processIsLoged());
    }
}
