<?php

namespace home\model;

use database\Connection;
use library\Translations;

class PagesModel
{
    private $db;
    private $translations;

    /**
     * method construct
     * create class Connection
     * create class Translations
     */

    public function __construct(Connection $connection, Translations $translations)
    {
        $this->db = $connection;
        $this->translations = $translations;
    }

    /**
     * method getPage
     * @param string url
     * @return array page 
     */

    public function getPage(string $url)
    {
        $sql = 'SELECT title, heading, text, description, keywords FROM pages WHERE url=? AND published=?';
        $param = [$url,  1];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            return ['page' => $this->db->getRows()[0], 'status' => true];
        }
        return ['page' => $this->translations->translateText('page-not-found'), 'status' => false];
    }
}
