<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;

class TitlePage implements ModuleInterface
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
        $this->module = $this->render->get('application/modules/TitlePage/templates/index', $data);
    }

    public function __toString()
    {
        return $this->module;
    }
}
