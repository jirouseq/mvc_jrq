<?php

namespace library;

use DI\Container;

class Router
{
    private $controller;
    private $method;
    private $param;

    /**
     * Constructor
     * 
     * Creates objects and call method call
     * 
     * @param object container
     */

    public function __construct(Language $language, Controller $controller, Method $method, Param $param)
    {
        //$language->init();
        $this->controller = $controller;
        $this->method = $method;
        $this->param = $param;
        $this->call();
    }

    /**
     * Method call
     * 
     * Call controller with method and parameters
     * 
     * @param object Create object from Controller class
     * @param object Create object from Method class
     * @param object Create object from Param class
     */

    private function call()
    {
        call_user_func_array([$this->controller->get(), $this->method->get()], [$this->param->get()]);
    }
}
