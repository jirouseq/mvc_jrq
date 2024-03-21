<?php

namespace library;

use configuration\Config;
use DI\Container;

require_once("vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $config;
    private $mailer;

    /**
     * method construct
     * @param class Config 
     */

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->mailer = new PHPMailer(true);
    }

    /**
     * method send
     * @param string nameEmail in config.json
     * @param string to
     * @param string subject
     * @param string body
     * @param string altBody
     * @param string atachment
     */

    public function send($nameEmail, $to, $subject, $body, $altBody, $attachment = null)
    {
        try {
            //$this->mailer->SMTPDebug = SMTP::DEBUG_SERVER; 
            $this->mailer->CharSet = "UTF-8";
            $this->mailer->isSMTP();
            $this->mailer->Host       = $this->config->getEmail($nameEmail)["host"];
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = $this->config->getEmail($nameEmail)["username"];
            $this->mailer->Password   = $this->config->getEmail($nameEmail)["password"];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mailer->Port       = 465;

            $this->mailer->setFrom($this->config->getEmail($nameEmail)["from"]["email"]);
            /* $this->mailer->addAddress('joe@example.net', 'Joe User'); */     //Add a recipient
            $this->mailer->addAddress($to);
            //$this->mailer->addReplyTo('info@example.com', 'Information');

            //Attachments
            /* $this->mailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $this->mailer->addAttachment('/tmp/image.jpg', 'new.jpg');    */ //Optional name

            //Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = $altBody;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
