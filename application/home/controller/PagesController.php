<?php

namespace home\controller;

use library\ParentController;

class PagesController extends ParentController
{

    /**
     * method index
     */

    public function index(): void
    {
        $data = $this->model->getPage($this->controllerData['url_original']);
        $this->setInfo(['title' => $data['page']['title'], 'metadescription' => $data['page']['description'], 'metakeywords' => $data['page']['keywords']]);
        $this->view('view', 'application' . DS . 'home' . DS . 'view' . DS . 'pages' . DS . 'index', $data);
    }
}
