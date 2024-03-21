<?php

namespace modules;

use interfaces\ModuleInterface;
use library\Render;
use database\Connection;
use library\Session;

class HeaderHome implements ModuleInterface
{

    private $render;
    private $module;
    private $db;
    private $session;


    /**
     * Constructor
     * Create object render
     */

    public function __construct(Render $render, Connection $connection, Session $session)
    {
        $this->render = $render;
        $this->db = $connection;
        $this->session = $session;
    }

    /**
     * Method init
     * 
     * Initializes the module and passes the data
     * @param array data 
     * 
     */

    public function init(array $data): void
    {
        $this->module = $this->render->get('application/modules/HeaderHome/templates/index', $this->getMenu());
    }

    private function getMenu()
    {
        $sql = 'SELECT id, title, url FROM pages WHERE menu = ? AND language_code=? ORDER BY orderMenu';
        $param = [1, $this->session->get('language', 'code')];
        $this->db->select($sql, $param);
        return $this->db->getRows();
    }

    public function __toString()
    {
        return $this->module;
    }
}
