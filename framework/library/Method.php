<?php

namespace library;

use configuration\Config;

class Method
{
    private $url;
    private $config;
    private $language;
    private $controller;
    private $method = 'index';

    /**
     * Constructor
     * 
     * Creates objects and call method set
     * 
     * @param object Url
     * @param object Config
     * @param object Language
     * @param object Controller
     */

    public function __construct(Url $url, Config $config, Language $language, Controller $controller)
    {
        $this->url = $url;
        $this->config = $config;
        $this->language = $language;
        $this->controller = $controller;
        $this->set();
    }

    /**
     * Method set
     * 
     * Sets the method
     */

    private function set(): void
    {
        if ($this->url->exist()) {
            $method = $this->findMethod($this->url->getBit());
            if (method_exists($this->controller->get(), $method)) {
                $this->method = $method;
                $this->url->unsetUrl();
            }
        }
    }

    /**
     * method findMethod
     * @param string url
     */

    private function findMethod($url)
    {
        foreach ($this->config->getRoutes('method') as $key => $controllerUrl) {
            if ($controllerUrl[$this->language->get()]['url'] === $url) {

                return $key;
            }
        }
        return $url;
    }

    /**
     * Method get
     * 
     * @return string method
     */

    public function get(): string
    {
        return $this->method;
    }
}
