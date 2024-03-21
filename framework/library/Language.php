<?php

namespace library;

use configuration\Config;

class Language
{

    private $config;
    private $session;
    private $url;
    private $translations;
    private $languageCode;

    /**
     * Constructor
     * 
     * Creates objects and calls the method set
     * 
     * @param object Container
     */

    public function __construct(Config $config, Session $session, Url $url, Translations $translations)
    {
        $this->config = $config;
        $this->session = $session;
        $this->url = $url;
        $this->translations = $translations;
        $this->init();
    }

    /**
     * Method setLanguage
     * 
     * Sets the application language
     * 
     * Calls the loadFile method on the translation object 
     * and sends the path to the language file
     */

    public function init(): void
    {
        if ($this->config->getMultilanguage()) {
            if ($this->url->exist()) {
                if (array_key_exists($this->url->getBit(), $this->config->getLanguages())) {
                    $this->languageCode = $this->url->getBit();
                    $this->url->unsetUrl();
                } else {
                    if ($this->session->exist('language', 'code')) {
                        $this->languageCode = $this->session->get('language', 'code');
                    } else {
                        $this->languageCode = $this->config->getDefaultLanguage();
                    }
                }
            } else {
                if ($this->session->exist('language', 'code')) {
                    $this->languageCode = $this->session->get('language', 'code');
                } else {
                    $this->languageCode = $this->config->getDefaultLanguage();
                }
            }
        } else {
            $this->languageCode = $this->config->getDefaultLanguage();
        }
        $this->session->set('language', ['code' => $this->languageCode]);
        $this->translations->loadFile('framework/languages/' . $this->languageCode);
    }

    /**
     * Method get
     * 
     * @return string language code
     */

    public function get(): string
    {
        return $this->languageCode;
    }
}
