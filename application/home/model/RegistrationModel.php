<?php

namespace home\model;

use database\Connection;
use library\Alerts;
use library\Session;
use library\Translations;

class RegistrationModel
{
    private $session;
    private $translations;
    private $db;
    private $alerts;
    private $status = true;
    private $isInvalid = [];

    /**
     * method construct
     * @param class Session
     * @param class Translations
     * @param class Connection
     * @param class Alerts
     */

    public function __construct(Session $session, Translations $translations, Connection $connection, Alerts $alerts)
    {
        $this->session = $session;
        $this->translations = $translations;
        $this->db = $connection;
        $this->alerts = $alerts;
    }

    /**
     * method userExist
     */

    public function userExist(): bool
    {
        return $this->session->exist('user', 'uid_authentication_user');
    }

    /**
     * method setUser
     * @param array data from post registration form
     */

    public function setUser(array $userData): array
    {
        $this->controlRobot('nickname');
        $this->controlUserName($userData['username']);
        $this->controlEmail($userData['userEmail']);
        $this->controlPassword($userData['password']);
        $this->controlPasswords($userData['password'], $userData['passwordAgain']);
        if ($this->status && $this->saveUser($userData)) {
            $this->login($userData);
            $this->alerts->set('alert-success', $this->translations->translateText('registration_success'));
        } else {
            $this->alerts->set('alert-danger', $this->translations->translateText('registration_error'));
        }
        return array_merge(['status' => $this->status, 'invalid' => $this->isInvalid], $this->status ? ['location' => URL] : []);
    }

    /**
     * method controlRobot
     * @param string input nickname
     */

    private function controlRobot(string $nickname): void
    {
        if (empty($nickname)) {
            $this->status = false;
        }
    }

    /**
     * method controlUserName
     * @param string validate user name
     */

    private function controlUserName(string $username): void
    {
        if (strlen($username) < 2) {
            $this->status = false;
            $this->setInvalid('username');
        }
    }

    /**
     * method controlEmail
     * @param string validate email
     */

    private function controlEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status = false;
            $this->setInvalid('userEmail');
        }
        $emailExist = $this->emailExist($email);
        if ($emailExist['status'] === false) {
            $this->status = false;
        }
    }

    /**
     * method emailExist
     * @param array email
     * @return array response
     */

    public function emailExist($email): array
    {
        $sql = 'SELECT id FROM users WHERE userEmail=? limit 1';
        $param = [$email];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            $return['status'] = false;
            $return['message'] = $this->translations->translateText('email-registered');
            $this->setInvalid('userEmail');
        } else {
            $return['status'] = true;
        }
        return $return;
    }

    /**
     * method controlPassword
     * @param string validate password
     */

    private function controlPassword(string $password): void
    {
        if (strlen($password) < 8) {
            $this->status = false;
            $this->setInvalid('password');
        }
    }

    /**
     * method controlPasswords
     * @param string validate passwords
     */

    private function controlPasswords(string $password, string $passwordAgain): void
    {
        if ($password !== $passwordAgain) {
            $this->status = false;
            $this->setInvalid('passwordAgain');
        }
    }

    /**
     * method saveUser
     * @param array validate password
     * @return bool true, false
     */

    private function saveUser($userData): bool
    {
        unset($userData['passwordAgain']);
        unset($userData['nickname']);
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        $userData['role'] = 'user';
        return $this->db->insert('users', $userData);
    }

    /**
     * method login
     * @param array user data
     */

    private function login($userData): void
    {
        $userId = $this->db->lastId();
        $this->setActiveUser($userId);
        $this->session->set('user', ['uid_authentication_user' => $userId]);
        $this->session->set('user', ['email' => $userData['userEmail']]);
        $this->session->set('user', ['username' => $userData['username']]);
        $this->session->set('user', ['role' => 'user']);
    }

    /**
     * method setActiveUser
     * @param int id user
     */

    private function setActiveUser($idUser): void
    {
        $this->db->update('users', ['active' => 1], ['id' => $idUser]);
    }

    /**
     * /**
     * method setInvalid
     * @param string invalid input name
     */

    private function setInvalid($name): void
    {
        $this->isInvalid[] = $name;
    }
}
