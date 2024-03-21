<?php

namespace modules;

use configuration\Config;
use interfaces\ModuleInterface;
use library\Render;
use library\Session;

class Languages implements ModuleInterface
{

    private $config;
    private $session;
    private $render;
    private $module;

    /**
     * Constructor
     * Create object render
     */

    public function __construct(Config $config, Session $session, Render $render)
    {
        $this->config = $config;
        $this->session = $session;
        $this->render = $render;
    }

    /**
     * Method init
     * 
     * Initializes the module and passes the data
     * @param array data 
     * 
     * language menu
     * 
     */

    public function init(array $data = null): void
    {
        $data['languages'] = $this->config->getLanguages();
        $data['active'] = $this->session->get('language', 'code');
        $this->module = $this->render->get('application/modules/Languages/templates/index', $data);
    }

    /**
     * method magic __toString
     * @return string template
     */

    public function __toString(): string
    {
        return $this->module;
    }
}
