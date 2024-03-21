<?php

namespace library;

class App
{
    private $router;
    private $template;

    /**
     * Constructor
     * Create object from Router class
     * Create object from Template class
     */

    public function __construct(Router $router, Template $template)
    {
        $this->router = $router;
        $this->template = $template;
        $this->template->printPage();
    }
}
