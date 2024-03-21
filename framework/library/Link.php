<?php

namespace library;

use configuration\Config;
use DI\Container;

class Link
{
    private $session;
    private $config;
    private $path;
    private $languageCode;

    /**
     * Constructor
     * 
     * Creates objects and calls the method set
     */

    public function __construct(Session $session, Config $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * Method get
     * 
     * A method for creating url links
     * 
     * @param string environment
     * @param string controller
     * @param string method
     * @param string language code
     */

    public function get(string $environment, string $controller, string $method = null, string $languageCode = null): string
    {
        $this->path = URL;
        $this->setLanguageCode($languageCode);
        $this->setEnvironment($environment);
        $this->setController($controller);
        $this->setMethod($method);
        return $this->path;
    }

    /**
     * method setLanguageCode
     */

    private function setLanguageCode(string $languageCode = null): void
    {
        $this->languageCode = $languageCode && key_exists($languageCode, $this->config->getLanguages()) ? $languageCode : $this->session->get('language', 'code');
        $this->path .= $this->config->getMultilanguage() ? $this->languageCode . DS : '';
    }

    /**
     * method setEnvironment
     */

    private function setEnvironment(string $environment): void
    {
        $this->path .= $environment === 'admin' ? 'admin' . DS : '';
    }

    /**
     * method setController
     */

    private function setController(string $controller): void
    {
        if (!key_exists($controller, $this->config->getRoutes('controller'))) {
            $controller = 'homepage';
        }
        $this->path .= $this->config->getRoutes('controller')[$controller][$this->languageCode]['url'] . DS;
    }

    /**
     * method setmethod
     */

    private function setMethod(string $method = null): void
    {
        if ($method && $method !== 'index') {
            $method = key_exists($method, $this->config->getRoutes('method')) ? $this->config->getRoutes('method')[$method][$this->languageCode]['url'] . DS : $method . DS;
        } else {
            $method = '';
        }
        $this->path .= $method;
    }
}
