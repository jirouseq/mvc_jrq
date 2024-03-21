<?php

namespace library;

use DI\Container;
use Exception;

abstract class ParentController
{
    private $page;
    private $response;
    protected $render;
    protected $log;
    protected $container;
    protected $model;
    protected $controllerData;

    /**
     * Constructor
     * 
     * @param object Container
     * @param string controller name
     * @param array controller info
     */

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->page = $this->container->get(Page::class);
        $this->response = $this->container->get(Response::class);
        $this->render = $this->container->get(Render::class);
        $this->log = $this->container->get(Log::class);
    }

    public function setData(array $data)
    {
        $this->controllerData = $data;
        $this->page->setEnvironment($data['environment']);
        $this->setInfo($data['info']);
        $this->setCss($data['environment'], $data['name']);
        $this->setJs($data['environment'], $data['name']);
        $this->model = $this->getModel($data['environment'], $data['name']);
    }

    /**
     * Method setInfoController
     * 
     * Saved title, description, keywords for controller
     * 
     * @param string info
     */

    protected function setInfo(array $info): void
    {
        $this->page->setInfo($info);
    }

    /**
     * Method setCssController
     * 
     * Saved path css file for controller
     * 
     * @param string css path
     */

    protected function setCss($environment, $controllerName): void
    {
        $this->page->setCss('application' . DS . $environment . DS . 'css' . DS . $controllerName);
    }

    /**
     * Method setJsController
     * 
     * Saved path js file for controller
     * 
     * @param string js path
     */

    protected function setJs($environment, $controllerName): void
    {
        $this->page->setJsController('application' . DS . $environment . DS . 'js' . DS . $controllerName);
    }

    /**
     * Method createModel
     * 
     * A method for creating model objects
     * 
     * @param object model
     */

    protected function getModel(string $environment, string $nameModel)
    {
        $useModel = '\\' . $environment . '\\model\\' . ucfirst($nameModel) . 'Model';
        if (class_exists($useModel)) {
            return $this->container->get($useModel);
        }
    }

    /**
     * Method setView
     * 
     * Stores view in object page
     * 
     * @param string tag
     * @param string pathView
     * @param array data for view
     */

    protected function view(string $tag, string $pathView, array $data)
    {
        $this->page->setView($tag, $this->render->get($pathView, $data));
    }

    /**
     * Method setView
     * 
     * Stores data in object response
     * 
     * @param array response
     */

    protected function response(array $response): void
    {
        $this->response->set($response);
    }


    /**
     * Method abstract index
     * 
     * The method can be used in any controller
     */

    abstract public function index();
}
