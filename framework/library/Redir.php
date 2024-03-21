<?php

namespace library;

class Redir
{
    /**
     * method to
     * 
     * @param string  url
     * 
     */

    public function to($url)
    {
        header('Location: ' . $url);
        exit();
    }
}
