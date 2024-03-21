<?php

namespace library;

use DI\Container;

class Render
{
    public $link;
    public $translations;
    public $modules;
    public $session;

    /**
     * Constructor
     * 
     * Creates objects
     * 
     * @param object Container
     */

    public function __construct(Link $link, Translations $translations, Modules $modules, Session $session)
    {
        $this->link = $link;
        $this->translations = $translations;
        $this->modules = $modules;
        $this->session = $session;
    }

    /**
     * Method get
     * 
     * Renders, translates and returns the view
     * 
     * @param string view path, example(''application/home/view/homePage/index)
     * @param array data for view
     */

    public function get(string $templatePath, array $data)
    {
        ob_start();
        extract($data, EXTR_SKIP);
        require_once(ROOT . $templatePath . ".php");
        return $this->translations->translateContent(ob_get_clean());
    }
}
