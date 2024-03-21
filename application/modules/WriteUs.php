<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;

class WriteUs implements ModuleInterface
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
     */

    public function init(array $data): void
    {
        $this->module = $this->render->get('application/modules/WriteUs/templates/index', $data);
    }

    public function __toString()
    {
        return $this->module;
    }
}
