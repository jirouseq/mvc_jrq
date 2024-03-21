<?php

namespace admin\model;

use database\Connection;

class DashboardModel
{

    private $db;
    private $dashboardData = [];

    /**
     * method construct
     * 
     * @param class Connection
     */

    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * method getDashboardData
     * @return array dashboard data
     */

    public function getDashboardData(): array
    {
        $this->dashboardData['users']['number'] = $this->getNumberUsers();
        $this->dashboardData['users']['active'] = $this->getNumberActiveUsers();
        $this->dashboardData['users']['banned'] = $this->getNumberBannedUsers();
        $this->dashboardData['pages']['number'] = $this->getNumberPages();
        $this->dashboardData['pages']['published'] = $this->getNumberPublishedPages();
        $this->dashboardData['pages']['no-published'] = $this->getNumberNoPublishedPages();
        return $this->dashboardData;
    }

    /**
     * method getDashboardData
     * @return int number users
     */

    private function getNumberUsers(): int
    {
        $sql = "SELECT COUNT(id) AS numUsers FROM users";
        $param = [];
        $this->db->select($sql, $param);
        return $this->db->getRows()[0]['numUsers'];
    }

    /**
     * method getNumberActiveUsers
     * @return int number active users
     */

    private function getNumberActiveUsers(): int
    {
        $sql = "SELECT COUNT(id) AS numUsers FROM users WHERE active=?";
        $param = [1];
        $this->db->select($sql, $param);
        return $this->db->getRows()[0]['numUsers'];
    }

    /**
     * method getNumberBannedUsers
     * @return int number banned users
     */

    private function getNumberBannedUsers(): int
    {
        $sql = "SELECT COUNT(id) AS numUsers FROM users WHERE banned=?";
        $param = [1];
        $this->db->select($sql, $param);
        return $this->db->getRows()[0]['numUsers'];
    }

    /**
     * method getNumberPages
     * @return int number pages
     */

    private function getNumberPages(): int
    {
        $sql = "SELECT COUNT(DISTINCT group_id) AS numRc FROM pages";
        $this->db->select($sql, []);
        $result = $this->db->getRows();
        return $result[0]['numRc'];
    }

    /**
     * method getNumberPublishedPages
     * @return int number published pages
     */

    private function getNumberPublishedPages(): int
    {
        $sql = "SELECT COUNT(DISTINCT group_id) AS numRc FROM pages WHERE published=?";
        $param = [1];
        $this->db->select($sql, $param);
        $result = $this->db->getRows();
        return $result[0]['numRc'];
    }

    /**
     * method getNumberNoPublishedPages
     * @return int number unpublished pages
     */

    private function getNumberNoPublishedPages(): int
    {
        $sql = "SELECT COUNT(DISTINCT group_id) AS numRc FROM pages WHERE published=?";
        $param = [0];
        $this->db->select($sql, $param);
        $result = $this->db->getRows();
        return $result[0]['numRc'];
    }
}
