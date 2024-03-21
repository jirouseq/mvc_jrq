<?php

namespace library;

class Response
{
    private $response = [];

    /**
     * Method set
     * 
     * Stores the response for asynchronous javascript
     */
    public function set(array $array): void
    {
        foreach ($array as $key => $val) {
            $this->response[$key] = $val;
        }
    }

    /**
     * Method set
     * 
     * @return array response for asynchronous javascript
     */

    public function get(): array
    {
        return $this->response;
    }
}
