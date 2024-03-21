<?php

namespace library;

use DI\Container;
use Exception;

class Modules
{

    private $container;
    private $session;
    private $translations;
    private $log;

    /**
     * Constructor
     * 
     * @param object Create object from Container class
     */

    public function __construct(Container $container, Session $session, Translations $translations, Log $log)
    {
        $this->container = $container;
        $this->session = $session;
        $this->translations = $translations;
        $this->log = $log;
    }

    /**
     * Method call
     * 
     * Creates and returns a module object
     * 
     * @param string name module
     * @param array data for module
     * @return object module
     */

    public function get(string $name, array $data)
    {
        $useModule = '\\modules\\' . ucfirst($name);
        if (class_exists($useModule)) {
            $module = $this->container->get($useModule);
            $this->loadLanguageFile($name);
            $module->init($data);
            return $module->__toString();
        } else {
            $this->log->set("Module not found: $name");
            throw new Exception("Module not found: $name");
        }
    }

    /**
     * Method get
     * 
     * Load module language file for translations
     * 
     * @param string name module
     */

    public function loadLanguageFile($name)
    {
        if (file_exists(ROOT . 'application' . DS . 'modules' . DS . $name . DS . 'languages' . DS . ucfirst($this->session->get('language', 'code')))) {
            $this->translations->loadFile('application' . DS . 'modules' . DS . $name . DS . 'languages' . DS . ucfirst($this->session->get('language', 'code')));
        }
    }
}
