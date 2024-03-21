<?php

namespace library;

class Alerts
{
    private $alerts = [];

    /**
     * Method set
     * 
     * Saves the alert by type
     * 
     * @param string type example with Bootstrap: (alert-danger, alert-success, alert-primary etc..)
     * @param string text alert 
     */

    public function set(string $type, string $alert): void
    {
        $this->alerts[$type][] = $alert;
    }

    /**
     * Method get
     * 
     * Returned alerts 
     * 
     * @return array alerts
     */

    public function get(): array
    {
        return $this->alerts;
    }
}
