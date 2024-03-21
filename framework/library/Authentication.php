<?php

namespace library;

use configuration\Config;
use database\Connection;

class Authentication
{
    private $config;
    private $session;
    private $db;

    /**
     * Constructor
     * Create object from Config class
     * Create object from Connection class
     * Create object from Session class
     */

    public function __construct(Config $config, Connection $connection, Session $session)
    {
        $this->config = $config;
        $this->db = $connection;
        $this->session = $session;
        if ($this->session->exist('user', 'uid_authentication_user') && intval($this->session->get('user', 'uid_authentication_user')) > 0) {
            $this->authenticate($this->session->get('user', 'uid_authentication_user'));
        }
    }

    /**
     * method authenticate
     * @param integer user id
     */

    private function authenticate($idUser): void
    {
        $sql = 'SELECT * FROM users WHERE id=?';
        $param = [$idUser];
        $this->db->select($sql, $param);
        if ($this->db->numRows()) {
            $user = $this->db->getRows()[0];
            if ($user['banned']) {
                $this->closeSession();
            }
        } else {
            $this->closeSession();
        }
    }

    /**
     * method close session
     */

    private function closeSession(): void
    {
        $this->session->delete('user');
    }
}
