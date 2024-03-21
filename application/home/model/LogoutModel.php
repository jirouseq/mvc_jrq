<?php

namespace home\model;

use library\Alerts;
use database\Connection;
use library\Link;
use library\Session;
use library\Translations;

class LogoutModel
{

    private $db;
    private $session;
    private $alerts;
    private $translations;
    private $link;

    /**
     * method construct
     * 
     * @param class Connection
     * @param class Session
     * @param class Alerts
     * @param class Translations
     * @param class Link
     */

    public function __construct(Connection $connection, Session $session, Alerts $alerts, Translations $translations, Link $link)
    {
        $this->db = $connection;
        $this->session = $session;
        $this->alerts = $alerts;
        $this->translations = $translations;
        $this->link = $link;
    }

    /**
     * method processLogout
     * 
     * @return array location for redirect
     */

    public function processLogout(): array
    {
        if ($this->session->exist('user', 'uid_authentication_user')) {
            $this->db->update('users', ['active' => 0], ['id' => $this->session->get('user', 'uid_authentication_user')]);
            $this->session->delete('user', null);
            $this->alerts->set('alert-success', $this->translations->translateText('logout_success'));
            return ['location' => $this->link->get('home', 'login', null, null), 'status' => true];
        }
        return ['status' => false];
    }
}
