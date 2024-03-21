<?php

namespace admin\model;

use database\Connection;
use library\Session;

class MenuModel
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

    /**
     * method getMenuItems
     */

    public function getMenuItems(): array
    {
        $sql = 'SELECT group_id, title FROM pages WHERE menu = ? AND language_code=? ORDER BY orderMenu';
        $param = [1, $this->session->get('language', 'code')];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            return $this->db->getRows();
        }
        return ['status' => false];
    }

    /**
     * method processUpdateSort
     * @param array from #sortableMenu
     */

    public function processUpdateSort($args): void
    {
        $orderArray = explode(',', $args['sort']);

        foreach ($orderArray as $index => $order) {
            $this->db->update('pages', ['orderMenu' => $index + 1], ['group_id' => $order]);
        }
    }
}
