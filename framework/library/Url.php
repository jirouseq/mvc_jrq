<?php

namespace library;

class Url
{

    private $url = '';
    private $urlBits = [];

    /**
     * Constructor 
     * 
     * Calls the method setUrl
     */

    public function __construct()
    {
        $this->set();
    }

    /**
     * Method set
     * 
     * @param string $url is $_GET['page'] from htaccess
     * @param array $urlBits is explode string $url
     */

    private function set(): void
    {
        if (isset($_GET['page']) && $_GET['page'] !== '') {
            $this->url = filter_var(rtrim($_GET['page']), FILTER_SANITIZE_URL);
            $this->urlBits = explode('/', $this->url);
            if (reset($this->urlBits) === "") {
                array_shift($this->urlBits);
            }
            if (end($this->urlBits) === "") {
                array_pop($this->urlBits);
            }
        }
    }

    /**
     * Method exist
     * 
     * Checks if the URL bits array is not empty.
     * 
     * @return bool returns true if the URL bits array is not empty; otherwise, it returns false.
     */

    public function exist(): bool
    {
        return !empty($this->urlBits) ? true : false;
    }

    /**
     * Method getBit
     * 
     * Retrieves a URL bit by its index.
     * 
     * @param int $index The index of the URL bit to retrieve.
     * @return string Returns the URL bit if it exists at the specified index; otherwise, it returns an empty string.
     */

    public function getBit(): string
    {
        return  isset($this->urlBits[0]) ? $this->urlBits[0] : "";
    }

    /**
     * Method unsetUrl
     * 
     * Removes the first element (index 0) from the URL bits array and re-indexes the array.
     */

    public function unsetUrl(): void
    {
        unset($this->urlBits[0]);
        $this->urlBits = array_values($this->urlBits);
    }

    /**
     * Method getUrlBits
     * 
     * @return array urlBits
     */

    public function getUrlBits(): array
    {
        return $this->urlBits;
    }
}
