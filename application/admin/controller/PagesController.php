<?php

namespace admin\controller;

use DI\Container;
use library\ParentController;
use library\Render;

class PagesController extends ParentController
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
     * @param integer number page for pagination
     */

    public function index($page = null): void
    {
        $page = !$page ? 1 : $page[0];
        $param = ['pagination' => ['page' => $page, 'perPage' => 25], 'search' => '', 'order' => ['id' => 'DESC']];
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'pages' . DS . 'index', $this->listPages($param));
    }

    /**
     * method add
     */

    public function add(): void
    {
        $data['languages'] = $this->model->getLanguages();
        $data['data'] = $this->model->createPage();
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'pages' . DS . 'form', $data);
    }

    /**
     * method edit
     * @param array id group pages
     */

    public function edit($groupId): void
    {
        $data['languages'] = $this->model->getLanguages();
        $data['data'] = $this->model->getVersionsPages($groupId[0]);
        $this->view('view', 'application' . DS . 'admin' . DS . 'view' . DS . 'pages' . DS . 'form', $data);
    }

    /**
     * method save
     * save data from form
     * @param array form data
     */

    public function save($dataForm): void
    {
        $this->response($this->model->processSave($dataForm));
    }

    /**
     * method deleteMessageConfirm
     * message confirm for delete page
     */

    public function deleteMessageConfirm()
    {
        $this->response($this->model->getDeleteMessageConfirm());
    }

    /**
     * method delete
     * delete page
     * @param array condition
     */

    public function delete($condition): void
    {
        $this->response($this->model->processDelete($condition));
    }

    /**
     * method requestListPages
     * async list pages
     * @param array param
     */

    public function requestListPages($param): void
    {
        $this->response($this->listPages($param));
    }

    /**
     * method listPages
     * @param array param
     * @return array data pages
     */

    private function listPages($param): array
    {
        $data = $this->model->getPages($param);
        $data['list'] = $this->render->get('application' . DS . 'admin' . DS . 'view' . DS . 'pages' . DS . 'list', $data);
        return $data;
    }

    /**
     * method links
     */

    public function links(): void
    {
        $this->response($this->model->getLinks());
    }
}
