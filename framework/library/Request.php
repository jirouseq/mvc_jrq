<?php

namespace library;

use DI\Container;

class Request
{
    private $async = false;

    /**
     * Constructor
     * 
     * Creates objects and calls the method set
     * 
     * @param object Create object from Url class
     */

    public function __construct()
    {
        $this->set();
    }

    /**
     * Method set
     * 
     * The method detects the existence of an asynchronous javascript 
     */

    private function set(): void
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->async = true;
        }
    }

    /**
     * Method set
     * 
     * Returned exist async request
     * 
     * @return bool 
     */

    public function get(): bool
    {
        return $this->async;
    }
}
