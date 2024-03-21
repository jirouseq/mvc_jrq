<?php

namespace configuration;

use database\Connection;

class Config
{
    private $routes;
    private $config;
    private $connection;
    private $controllerData = [];


    /**
     * Constructor
     * 
     * Creates objects and initial database
     * 
     * @param object Create object from Connection class
     */

    public function __construct(Connection $connection)
    {

        define('DS', DIRECTORY_SEPARATOR);
        $this->config = json_decode(file_get_contents(ROOT . 'framework' . DS . 'configuration' . DS . 'Config.json'), true);
        $this->routes = json_decode(file_get_contents(ROOT . 'framework' . DS . 'configuration' . DS . 'Routes.json'), true);
        $this->connection = $connection;
        $this->connection->init($this->config['database']['db_host'], $this->config['database']['db_name'], $this->config['database']['db_user'], $this->config['database']['db_password']);

        $subdirectory = $this->config['url']['subdirectory'];
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
        define("URL", $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . $subdirectory);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getRoutes($type)
    {
        return $this->routes[$type];
    }

    /**
     * Method getMultilanguage
     * 
     * Returns whether the website is multilingual
     * 
     * @return bool isMultilanguage
     */

    public function getMultilanguage(): bool
    {
        return $this->config['languages']['multilanguage'];
    }

    /**
     * Method getLanguages
     * 
     * Returns array with languages
     * 
     * @return array languages
     */

    public function getLanguages(): array
    {
        return $this->config['languages']['lang'];
    }

    /**
     * Method getDefaultLanguage
     * 
     * Returns defaultLanguage
     * 
     * @return string defaultLanguage
     */

    public function getDefaultLanguage(): string
    {
        return $this->config['languages']['default'];
    }

    /**
     * Method getAdminEnvironmentRoles
     * 
     * Returns array with roles for users
     * 
     * @return array adminEnvironmentRoles
     */

    public function getRoles(): array
    {
        return $this->config['roles'];
    }

    /**
     * Method getEmails
     * 
     * Returns array with emails, example(admin@xxxx.yy, system@xxxx.yy, main@xxxx.yy);
     * 
     * @return array emails
     */

    public function getEmails(): array
    {
        return $this->config['emails'];;
    }

    /**
     * Method getEmails
     * 
     * Returns array with emails, example(admin@xxxx.yy, system@xxxx.yy, main@xxxx.yy);
     * 
     * @return array emails
     */

    public function getEmail($name): array
    {
        return $this->config['emails'][$name];
    }

    /**
     * Method emailForContact
     * 
     * Returns  email ;
     * 
     * @return string email
     */

    public function emailForContact(): string
    {
        return $this->config['emailForContact'];
    }
}
