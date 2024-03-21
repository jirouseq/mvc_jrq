<?php

namespace library;

class Session
{
    /**
     * Method exist
     * 
     * Return is exist $_SESSION with values
     * 
     * @param string name section (example: $_SESSION['user'])
     * @param string key for section (example: $_SESSION['user']['uid])
     * @return bool return true or false
     */

    public function exist(string $section, string $name = null): bool
    {
        if ($name === null) {
            return isset($_SESSION[$section]) ? true : false;
        }
        return isset($_SESSION[$section][$name]) ? true : false;
    }

    /**
     * Method set
     * 
     * Stores values ​​in session
     * 
     * @param string name section (example: $_SESSION['user'])
     * @param array values for section (example: $_SESSION[$section] = ['id'=>1]) 
     */

    public function set(string $section, array $value): void
    {
        foreach ($value as $key => $val) {
            $_SESSION[$section][$key] = $val;
        }
    }

    /**
     * Method get
     * 
     * return session
     * 
     * @param string name section (example: $_SESSION['user'])
     * @param string key for section (example: $_SESSION[$section][$key]) 
     */

    public function get(string $section, string $key)
    {
        return $this->exist($section, $key) ? $_SESSION[$section][$key] : null;
    }

    /**
     * Method delete
     * 
     * Delete session
     * 
     * @param string name section (example: $_SESSION['user'])
     * @param string key for section (example: $_SESSION[$section][$key]) 
     */

    public function delete(string $section, string $key = null): void
    {
        if (isset($_SESSION[$section])) {
            if ($key !== null && isset($_SESSION[$section][$key])) {
                unset($_SESSION[$section][$key]);
            } else {
                unset($_SESSION[$section]);
            }
        }
    }
}
