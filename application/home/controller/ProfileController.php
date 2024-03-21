<?php

namespace home\controller;

use DI\Container;
use library\ParentController;
use library\Redir;

class ProfileController extends ParentController
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
     * methd index
     */

    public function index(): void
    {
        $data = $this->model->getUser();
        if ($data) {
            $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'profile' . DS . 'index', $data);
        } else {
            $this->redir->to($this->model->getRedirUrl());
        }
    }

    /**
     * methd changeProfile
     */

    public function changeProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->response($this->model->processChangeProfile($_POST));
        }
    }
}
