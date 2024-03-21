<?php

namespace home\model;

use database\Connection;
use library\Alerts;
use library\Link;
use library\Mailer;
use library\Translations;

class ForgottenPasswordModel
{
    private $db;
    private $mailer;
    private $link;
    private $translations;
    private $alerts;

    /**
     * constructor
     * @param class Connection
     * @param class Mailer
     * @param class Link
     * @param class Translations
     * @param class Alarms
     */

    public function __construct(Connection $connection, Mailer $mailer, Link $link, Translations $translations, Alerts $alerts)
    {
        $this->db = $connection;
        $this->mailer = $mailer;
        $this->link = $link;
        $this->translations = $translations;
        $this->alerts = $alerts;
    }

    /**
     * method send token
     * @param array from controller
     */

    public function processSendToken(array $userData): void
    {
        if (filter_var($userData['userEmail'], FILTER_VALIDATE_EMAIL)) {
            $idUser = $this->emailExist($userData['userEmail']);
            if ($idUser) {
                $token = $this->createToken();
                if ($this->setToken($idUser, $token)) {
                    $this->sendEmail($userData['userEmail'], $token);
                }
            }
        }
    }

    /**
     * method emailExist
     * @param string email
     * @return integer id user 
     * @return bool false
     */

    private function emailExist(string $email)
    {
        $sql = 'SELECT id FROM users WHERE userEmail=?';
        $param = [$email];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            return $this->db->getRows()[0]['id'];
        }

        return false;
    }

    /**
     * method createToken
     * 
     */

    private function createToken()
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * methos setToken
     * @param integer id user
     * @param string token
     * @return bool
     */

    private function setToken(int $idUser, string $token): bool
    {
        return $this->db->insert('user_token', ['id_user' => $idUser, 'token' => $token]);
    }

    /**
     * method sendMail
     * @param string email
     * @param string token
     */

    private function sendEmail($email, $token): void
    {
        $tokenLink = '<a href="' . $this->link->get('home', 'forgottenPassword', 'reset', null) . $token . '">' . $this->translations->translateText('link-restore-password') . '</a>';
        $subject = $this->translations->translateText('password-recovery-request');
        $body = $tokenLink;
        $this->mailer->send('admin', $email, $subject, $body, null);
    }

    /**
     * method reset
     * @param string token
     * @return bool token exist
     */

    public function processReset($token)
    {
        $user = $this->tokenValid($token);
        if (is_array($user)) {
            return $user;
        }
    }

    /**
     * method tokenValid
     * @param string token
     */

    private function tokenValid($token)
    {
        $sql = 'SELECT id_user, createTime FROM user_token WHERE token=?';
        $param = [$token];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            $rc = $this->db->getRows()[0];
            $currentTimestamp = time();
            $createToken = strtotime($rc['createTime']);
            $timeDiference = $currentTimestamp - $createToken;
            $expiration = 2 * 24 * 60 * 60;
            if ($timeDiference > $expiration) {
                $this->deleteToken($token);
                $return['status'] = false;
            } else {
                $return['status'] = true;
                $return['id_user'] = $rc['id_user'];
            }
            return $return;
        }
        return false;
    }

    /**
     * method delete old token
     * @param string token
     */

    private function deleteToken($token): void
    {
        $this->db->delete('user_token', ['token' => $token]);
    }

    /**
     * method restore
     * @param array data from form
     */

    public function processRestore($userData): array
    {
        if (strlen($userData['password']) < 8 && $userData['password'] !== $userData['passwordAgain']) {
            return ['status' => false];
        }
        $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        if ($this->db->update('users', ['password' => $passwordHash], ['id' => $userData['idUser']])) {
            if ($this->db->delete('user_token', ['id_user' => $userData['idUser']])) {
                $this->alerts->set('alert-primary', $this->translations->translateText('registration_success'));
                return ['status' => true, 'location' => $this->link->get('home', 'login', null, null)];
            }
        }
        return ['status' => false];
    }
}
