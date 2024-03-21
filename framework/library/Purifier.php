<?php

namespace library;


use HTMLPurifier;

require_once('vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php');

class Purifier
{
    public $purifier;

    /**
     * Constructor
     * 
     * Create purifier
     * 
     * @param object Create object from HTMLpurifier
     */

    public function __construct()
    {
        $this->purifier = new HTMLPurifier();
    }

    /**
     * method getPurifier
     */

    public function getPurifier(): object
    {
        return $this->purifier;
    }
}
