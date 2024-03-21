<?php

namespace library;

use configuration\Config;

class Environment
{

    private $url;
    private $session;
    private $redir;
    private $link;
    private $config;
    private $environment = 'home';

    /**
     * Constructor
     * 
     * Creates objects and call method set
     * 
     * @param object Container
     */

    public function __construct(Url $url, Session $session, Redir $redir, Link $link, Config $config)
    {
        $this->url = $url;
        $this->session = $session;
        $this->redir = $redir;
        $this->link = $link;
        $this->config = $config;
        $this->set();
    }

    /**
     * Method set
     * 
     * Sets the environment for frontend (home) or backend (admin)
     */

    public function set(): void
    {
        if ($this->url->exist() && $this->url->getBit() === 'admin') {
            if ($this->session->exist('user', 'role') && array_key_exists($this->session->get('user', 'role'), $this->config->getRoles())) {
                $this->environment = 'admin';
                $_SESSION['KCFINDER'] = array(
                    'disabled' => false
                );
            } else {
                $_SESSION['KCFINDER'] = array(
                    'disabled' => true,
                );
                $this->redir->to($this->link->get('home', 'login', null, null));
            }
            $this->url->unsetUrl();
        }
    }

    /**
     * Method get
     * 
     * Get environment
     * 
     *  @return string environment (home or admin)
     */

    public function get(): string
    {
        return $this->environment;
    }
}
