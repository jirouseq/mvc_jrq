<?php

namespace home\model;

use database\Connection;
use library\Session;

class HomepageModel
{
    private $db;
    private $session;

    /**
     * method construct
     * @param class Connection
     * @param class Session
     */

    public function __construct(Connection $connection, Session $session)
    {
        $this->db = $connection;
        $this->session = $session;
    }

    /**
     * method getHomepage
     * @return array homepage || error
     */

    public function getHomepage(): array
    {
        $sql = 'SELECT text FROM pages WHERE homepage=? AND language_code=? AND published=?';
        $param = [1, $this->session->get('language', 'code'), 1];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            return ['homepage' => $this->db->getRows()[0]['text']];
        }
        return ['homepage' => 'page-not-found'];
    }
}
