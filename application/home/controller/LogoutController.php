<?php

namespace home\controller;

use DI\Container;
use library\ParentController;
use library\Redir;

class LogoutController extends ParentController
{

    private $redir;

    /**
     * method __construct
     * 
     * @param class Container
     * 
     * @param class redir
     */

    public function __construct(Container $container, Redir $redir)
    {
        parent::__construct($container);
        $this->redir = $redir;
    }

    /**
     * method index from parrentController abstract method index
     */

    public function index(): void
    {
        //index
    }

    /**
     * method logout
     */

    public function logout(): void
    {
        $returnData = $this->model->processLogout();
        $this->redir->to($returnData['location']);
    }

    /**
     * method logout async
     */

    public function logoutResponse(): void
    {
        $returnData = $this->model->processLogout();
        $this->response($returnData);
    }
}
