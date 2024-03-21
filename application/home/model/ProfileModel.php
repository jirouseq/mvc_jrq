<?php

namespace home\model;

use database\Connection;
use library\Alerts;
use library\Link;
use library\Session;
use library\Translations;

class ProfileModel
{
    private $db;
    private $session;
    private $alerts;
    private $translations;
    private $link;
    private $status = true;

    /**
     * method construct
     * @param class Connection
     * @param class Session
     * @param class Alerts
     * @param class Tranlsations
     * @param class Link
     */

    public function __construct(Connection $connection, Session $session, Alerts $alerts, Translations $translations, Link $link)
    {
        $this->db = $connection;
        $this->session = $session;
        $this->alerts = $alerts;
        $this->link = $link;
        $this->translations = $translations;
    }

    /**
     * method getUser
     * @return array detail user
     */

    public function getUser()
    {
        $sql = 'SELECT username, userEmail FROM users WHERE id=?';
        $param = [$this->session->get('user', 'uid_authentication_user')];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            return $this->db->getRows()[0];
        }
        return false;
    }

    /**
     * method getRedirUrl
     * @return string
     */

    public function getRedirUrl(): string
    {
        return $this->link->get('home', 'login', null, null);
    }

    /**
     * method processChangeProfile
     * @param array form data
     * @return array response
     */

    public function processChangeProfile(array $formData): array
    {
        if (isset($formData['username'], $formData['userEmail'], $formData['password'], $formData['passwordAgain'])) {
            $this->controlUserName($formData['username']);
            $this->controlEmail($formData['userEmail']);
            $this->controlPassword($formData['password']);
            $this->controlPasswords($formData['password'], $formData['passwordAgain']);
            if ($this->status && $this->updateProfile($formData)) {
                $response['alert'] = $this->alerts->set('alert-success', $this->translations->translateText('change-success'));
            } else {
                $response['alert'] = $this->alerts->set('alert-danger', $this->translations->translateText('change-error'));
            }
            $response['location'] = $this->link->get('home', 'profile', null, null);
            return $response;
        }
    }

    /**
     * method controlUserName
     * @param string validate username
     */

    private function controlUserName(string $username): void
    {
        if (strlen($username) < 2) {
            $this->status = false;
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
        }
    }

    /**
     * method controlPassword
     * @param string validate password
     */

    private function controlPassword(string $password): void
    {
        if (strlen($password) < 8 && !empty($password)) {
            $this->status = false;
        }
    }

    /**
     * method controlPasswords
     * @param string validate passwords
     */

    private function controlPasswords(string $password, string $passwordAgain): void
    {
        if (!empty($password) && $password !== $passwordAgain) {
            $this->status = false;
        }
    }

    /**
     * method updateProfile
     * @param string validate username
     * @return bool true, false
     */

    private function updateProfile(array $userData): bool
    {
        unset($userData['passwordAgain']);
        if ($userData['password'] === '') {
            unset($userData['password']);
        } else {
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        }
        return $this->db->update('users', $userData, ['id' => $this->session->get('user', 'uid_authentication_user')]);
    }
}
