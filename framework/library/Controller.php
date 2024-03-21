<?php

namespace library;

use configuration\Config;
use DI\Container;

class Controller
{
    private $url;
    private $environment;
    private $config;
    private $language;
    private $container;
    private $objectController;
    private $data = [];

    /**
     * Constructor
     * 
     * Creates objects and call method set
     * 
     * @param object Create object from Url class
     * @param object Create object from Environment class
     * @param object Create object from Config class
     * @param object Create object from Language class
     * @param object Create object from Container class
     */

    public function __construct(Url $url, Environment $environment, Config $config, Language $language, Container $container)
    {
        $this->container = $container;
        $this->url = $url;
        $this->environment = $environment;
        $this->config = $config;
        $this->language = $language;
        $this->set();
    }

    /**
     * Method set
     * 
     * Creates an object for the controller
     */

    private function set(): void
    {
        if ($this->url->exist()) {
            $this->data['url_original'] = $this->url->getBit();
            $this->data['name'] = $this->findController($this->url->getBit());
            $this->url->unsetUrl();
        } else {
            $this->data['name'] = 'homepage';
        }
        $this->objectController = $this->createController();
    }

    /**
     * Method createControllers
     */

    private function createController()
    {
        $nameSpace = '\\' . $this->environment->get() . '\\controller\\';
        if ($this->data['name'] === null) {
            if ($this->environment->get() === 'admin') {
                $this->data['name'] = 'error';
            } else {
                $this->data['name'] = 'pages'; // or error
            }
        }
        $useController = $nameSpace . ucfirst($this->data['name']) . 'Controller';
        $controller =  $this->container->get($useController);
        $controller->setData($this->getdata());
        return $controller;
    }

    /**
     * Method getController
     * 
     * @param string  url controller
     * @return string controller name
     */

    private function findController($url)
    {
        foreach ($this->config->getRoutes('controller') as $key => $controllerUrl) {
            if ($controllerUrl[$this->language->get()]['url'] === $url || $key === $url) {
                return $key;
            }
        }
        return null;
    }

    /**
     * Method getName
     * 
     * @return string controllerName
     */
    public function getData()
    {
        $this->data['info'] = $this->getInfo();
        $this->data['environment'] = $this->environment->get();
        return $this->data;
    }

    /**
     * Method getController
     * 
     * @param string  url controller
     * @return string controller name
     */

    public function getInfo()
    {
        return $this->config->getRoutes('controller')[$this->data['name']][$this->language->get()];
    }



    /**
     * Method get
     * 
     * @return object controller
     */
    public function get()
    {
        return $this->objectController;
    }
}
