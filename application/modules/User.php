<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;

class User implements ModuleInterface
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
     * user menu
     * 
     */

    public function init(array $data = null): void
    {
        $this->module = $this->render->get('application/modules/User/templates/index', $data);
    }

    public function __toString()
    {
        return $this->module;
    }
}
