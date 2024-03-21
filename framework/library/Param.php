<?php

namespace library;

class Param
{
    private $url;
    private $params = [];

    /**
     * Constructor
     * 
     * Creates objects and call method set
     * 
     * @param object Create object from Url class
     */

    public function __construct(Url $url)
    {
        $this->url = $url;
        $this->set();
    }

    /**
     * Method set
     * 
     * Sets the parameters
     */

    private function set(): void
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if (is_array($post)) {
            $this->params = $post;
        } else {
            $this->params = $this->url->getUrlBits();
        }
    }

    /**
     * Method get
     * 
     * @return array parameters
     */

    public function get(): array
    {
        return $this->params;
    }
}
