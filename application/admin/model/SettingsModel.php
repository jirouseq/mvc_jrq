<?php

namespace admin\model;

use database\Connection;
use library\Session;

class SettingsModel
{

    private $db;
    private $session;

    /**
     * method construct
     * 
     * @param class Connection
     * @param class Session
     */

    public function __construct(Connection $connection, Session $session)
    {
        $this->db = $connection;
        $this->session = $session;
    }
}
