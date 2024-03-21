<?php

namespace home\model;

use configuration\Config;
use database\Connection;
use library\Alerts;
use library\Link;
use library\Mailer;
use library\Session;
use library\Translations;

class ContactFormModel
{
    private $db;
    private $session;
    private $alerts;
    private $link;
    private $translations;
    private $mailer;
    private $config;
    private $status = true;

    /**
     * method construct
     * @param class Connection
     * @param class Session
     * @param class Alerts
     * @param class Link
     * @param class Translations
     * @param class Mailer
     * @param class Config
     */

    public function __construct(Connection $connection, Session $session, Alerts $alerts, Link $link, Translations $translations, Mailer $mailer, Config $config)
    {
        $this->db = $connection;
        $this->session = $session;
        $this->alerts = $alerts;
        $this->link = $link;
        $this->translations = $translations;
        $this->mailer = $mailer;
        $this->config = $config;
    }

    /**
     * method processSendForm
     * @param array from contact form
     * @return array after send contact form
     */

    public function processSendForm(array $formData): array
    {
        if (isset($formData['nickname'], $formData['subject'], $formData['body'], $formData['email'])) {
            $this->controlNickname($formData['nickname']);
            $this->controlTextInput($formData['subject']);
            $this->controlTextInput($formData['body']);
            $this->controlEmail($formData['email']);
        }

        if ($this->status) {
            if ($this->sendMail($formData)) {
                $this->alerts->set('alert-success', $this->translations->translateText('contact_form_send'));
                return ['location' => $this->link->get('home', 'contactForm', null, null)];
            } else {
                $this->alerts->set('alert-danger', $this->translations->translateText('contact_form_send'));
                return ['location' => $this->link->get('home', 'contactForm', null, null)];
            }
        } else {
            return ['status' => false];
        }
    }

    /**
     * method controlNickname
     * elimination robots 
     * @param string nickname
     */

    private function controlNickname(string $nickname): void
    {
        if ($nickname !== '') {
            $this->status = false;
        }
    }

    /**
     * method controlTextInput
     * @param string subject and tex message
     */

    private function controlTextInput($subject): void
    {
        if (strlen($subject) < 1) {
            $this->status = false;
        }
    }

    /**
     * method controlEmail
     * @param string email
     */

    private function controlEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status = false;
        }
    }

    /**
     * method sendMail
     * @param array dataform
     * @return bool true, false
     */

    private function sendMail(array $dataForm): bool
    {
        $body = '<p>' . $dataForm['body'] . '</p>';
        $body .= '<p>' . $dataForm['email'] . '</p>';

        return $this->mailer->send('admin', $this->config->emailForContact(), $dataForm['subject'], $body, null);
    }
}
