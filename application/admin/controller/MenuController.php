<?php

namespace admin\controller;

use DI\Container;
use library\ParentController;
use library\Render;

class MenuController extends ParentController
{

    protected $render;

    /**
     * method construct
     * @param class Container
     * @param class redir
     */

    public function __construct(Container $container, Render $render)
    {
        parent::__construct($container);
        $this->render = $render;
    }

    /**
     * method index
     */

    public function index(): void
    {
        $data = $this->model->getmenuItems();
        $response['template'] = $this->render->get('application' . DS . 'admin' . DS . 'view' . DS . 'menu' . DS . 'index', $data);
        $this->response($response);
    }

    /**
     * method updateSort
     * @param array from #sortableMenu
     */

    public function updateSort($arg): void
    {
        $this->model->processUpdateSort($arg);
    }
}
