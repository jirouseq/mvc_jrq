<?php

namespace admin\model;

use database\Connection;
use library\DatabaseSearch;
use library\Link;

class UsersModel
{

    private $db;
    private $dbSearch;
    private $link;

    /**
     * method construct
     * 
     * @param class Connection
     * @param class DatabaseSearch
     * @param class Link
     */

    public function __construct(Connection $connection, DatabaseSearch $databaseSearch, Link $link)
    {
        $this->db = $connection;
        $this->dbSearch = $databaseSearch;
        $this->link = $link;
    }

    /**
     * method getDataUsers
     * @param array from list table / users.js
     * @return array location for redirect
     */

    public function getDataUsers(array $data = null): array
    {
        $this->dbSearch->table('users');
        $this->dbSearch->columns(['id', 'username', 'userEmail', 'banned', 'active', 'createDate', 'role']);
        if (is_array($data)) {
            $this->dbSearch->search(['id', 'username', 'userEmail', 'role'], $data['search']);
            $this->dbSearch->where(['role' => ['!=', 'superAdmin']]);
            $this->dbSearch->order($data['order']);
            $this->dbSearch->pagination($data['pagination']);
        }
        $data = $this->dbSearch->getData();
        $data['pagination']['url'] = $this->link->get('admin', 'users', null, null);
        $data['roles'] = $this->getRoles();
        return $data;
    }

    /**
     * method getRoles
     * 
     * @return array roles for select option
     */

    private function getRoles(): array
    {
        $sql = 'SELECT role FROM roles';
        $param = [];
        $this->db->select($sql, $param);
        return $this->db->getRows();
    }

    /**
     * method processBan
     * 
     * @param array userData from users.js
     */

    public function processBan($userData): void
    {
        $this->db->update('users', ['banned' => $userData['banned']], ['id' => $userData['id']]);
    }

    /**
     * method processChangeRole
     * 
     * @param array userData from users.js
     */

    public function processChangeRole(array $userData): void
    {
        $this->db->update('users', ['role' => $userData['role']], ['id' => $userData['id']]);
    }
}
