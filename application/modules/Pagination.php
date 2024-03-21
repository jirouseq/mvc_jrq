<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;

class Pagination implements ModuleInterface
{

    private $render;
    private $module;

    /**
     * Constructor
     * Create object render
     */

    public function __construct(Render $render)
    {
        $this->render = $render;
    }

    /**
     * Method init
     * 
     * Initializes the module and passes the data
     * @param array data 
     * 
     * pagination url: https://domain/homepage/page/
     * 
     * $url = $this->link->get('home', 'homepage', 'index', null) . 'page' . DS; 
     * 
     * data example: ['page' => 1, numPages => 10, 'url' => $url]
     * 
     */

    public function init(array $data): void
    {
        $this->module = $this->render->get('application/modules/Pagination/templates/index', $data);
    }

    public function __toString()
    {
        return $this->module;
    }
}
