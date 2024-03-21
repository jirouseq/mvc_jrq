<?php

namespace admin\controller;

use DI\Container;
use library\ParentController;
use library\Render;

class UsersController extends ParentController
{

    protected $render;

    /**
     * method construct
     * @param class Container
     * @param class render
     */

    public function __construct(Container $container, Render $render)
    {
        parent::__construct($container);
        $this->render = $render;
    }

    /**
     * method index
     * @param integer number page for pagination
     */

    public function index(array $page = null): void
    {
        $page = !$page ? 1 : $page[0];
        $param = ['pagination' => ['page' => $page, 'perPage' => 25], 'search' => '', 'order' => []];
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'users' . DS . 'index', $this->getList($param));
    }

    /**
     * method getResponse async
     * @param array users
     */

    public function getResponse(array $param): void
    {
        $this->response($this->getList($param));
    }

    /**
     * method getList
     * @param array sort data
     * @return array template users
     */

    private function getList(array $param): array
    {
        $data = $this->modelData($param);
        $data['list'] = $this->render->get('application' . DS . 'admin' . DS . 'view' . DS . 'users' . DS . 'list', $data);
        return $data;
    }

    /**
     * method modelData
     * @param array sort data
     * @return array data users
     */

    private function modelData(array $param): array
    {
        return $this->model->getDataUsers($param);
    }

    /**
     * method ban
     * @param array data user
     */

    public function ban(array $userData): void
    {
        $this->model->processBan($userData);
    }

    /**
     * method user cgange role
     * @param array data user
     */

    public function role(array $userData): void
    {
        $this->model->processChangeRole($userData);
    }
}
