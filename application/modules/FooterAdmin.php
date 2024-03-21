<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;

class FooterAdmin implements ModuleInterface
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
     */

    public function init(array $data): void
    {
        $this->module = $this->render->get('application/modules/FooterAdmin/templates/index', $data);
    }

    public function __toString()
    {
        return $this->module;
    }
}
