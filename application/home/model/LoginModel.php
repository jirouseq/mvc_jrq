<?php

namespace home\model;

use database\Connection;
use library\Alerts;
use library\Link;
use library\Session;
use library\Translations;

class LoginModel
{
    private $session;
    private $translations;
    private $db;
    private $alerts;
    private $link;
    private $status = true;
    private $message = '';

    /**
     * method construct
     * @param class Session
     * @param class Translations
     * @param class Connection
     * @param class Alerts
     */

    public function __construct(Session $session, Translations $translations, Connection $connection, Alerts $alerts, Link $link)
    {
        $this->session = $session;
        $this->translations = $translations;
        $this->db = $connection;
        $this->alerts = $alerts;
        $this->link = $link;
    }

    /**
     * method userExist
     */

    public function userExist(): bool
    {
        return $this->session->exist('user', 'uid_authentication_user');
    }

    /**
     * method login
     * @param array from loginController
     * @return array for response
     */

    public function processLogin($formData): array
    {
        $this->controlEmail($formData['userEmail']);
        $this->controlUser($formData);
        return array_merge(['status' => $this->status, 'message' => $this->message], $this->status ? ['location' => URL] : [], $formData);
    }

    /**
     * method controlEmail
     * @param string address 
     */

    private function controlEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status = false;
            $this->message = $this->translations->translateText('email_password_error');
        }
    }

    /**
     * method controlUser
     * @param array data from loginForm
     */

    private function controlUser(array $args)
    {
        if ($this->status) {
            $sql = 'SELECT * FROM users WHERE userEmail=?';
            $param = [$args['userEmail']];
            $this->db->select($sql, $param);
            if ($this->db->numRows() > 0) {
                $user = $this->db->getRows()[0];
                if (password_verify($args['password'], $user['password'])) {
                    $this->setActiveUser($user['id']);
                    $this->setSession($user);
                } else {
                    $this->status = false;
                    $this->message = $this->translations->translateText('email_password_error');
                }
            } else {
                $this->status = false;
                $this->message = $this->translations->translateText('email_password_error');
            }
        }
    }

    /**
     * method setActiveUser
     */

    private function setActiveUser($idUser)
    {
        $this->db->update('users', ['active' => 1], ['id' => $idUser]);
    }

    /**
     * method setSession
     * @param array user data
     */

    public function setSession(array $user)
    {
        if (!$user['banned']) {
            $this->session->set('user', ['uid_authentication_user' => $user['id']]);
            $this->session->set('user', ['email' => $user['userEmail']]);
            $this->session->set('user', ['username' => $user['username']]);
            $this->session->set('user', ['role' => $user['role']]);
            $this->alerts->set('alert-success', $this->translations->translateText('login_success'));
        } else {
            $this->status = false;
            $this->message = $this->translations->translateText('login_error');
        }
    }

    /**
     * method process control loged
     * @return array return
     */

    public function processIsLoged(): array
    {
        $return['status'] = $this->session->exist('user', 'uid_authentication_user') ? true : false;
        if (!$return['status']) {
            $return['location'] = $this->link->get('home', 'login', null, null);
        }
        return $return;
    }
}
