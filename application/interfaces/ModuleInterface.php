<?php

namespace interfaces;


interface ModuleInterface
{
    /**
     * Method init in interface
     * 
     * Initializes the module and passes the data
     * @param array data
     */

    public function init(array $data);
}
