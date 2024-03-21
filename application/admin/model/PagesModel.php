<?php

namespace admin\model;

use configuration\Config;
use database\Connection;
use library\DatabaseSearch;
use library\Link;
use library\Session;
use library\Translations;

class PagesModel
{

    private $db;
    private $dbSearch;
    private $link;
    private $session;
    private $config;
    private $translations;

    /**
     * method construct
     * 
     * @param class Connection
     * @param class DatabaseSearch
     * @param class Link
     */

    public function __construct(Connection $connection, DatabaseSearch $databaseSearch, Link $link, Session $session, Config $config, Translations $translations)
    {
        $this->db = $connection;
        $this->dbSearch = $databaseSearch;
        $this->link = $link;
        $this->session = $session;
        $this->config = $config;
        $this->translations = $translations;
    }

    /**
     * method getDataUsers
     * @param array from list table / users.js
     * @return array location for redirect
     */

    public function getPages(array $data = null): array
    {
        $this->dbSearch->table('pages');
        $this->dbSearch->columns(['id', 'published', 'homepage', 'title', 'createDate', 'authorName', 'menu', 'group_id']);
        if (is_array($data)) {
            $this->dbSearch->search(['id', 'title', 'heading', 'text', 'description', 'keywords', 'authorName'], $data['search']);
            $this->dbSearch->where(['language_code' => ['=', $this->session->get('language', 'code')]]);
            $this->dbSearch->order($data['order']);
            $this->dbSearch->pagination($data['pagination']);
        }
        $data = $this->dbSearch->getData();
        $data['pagination']['url'] = $this->link->get('admin', 'pages', null, null);
        return $data;
    }

    /**
     * method processSwitcher
     * change switch in database (menu, published, homepage)
     * @param array from switch
     */

    public function processSwitcher($data): void
    {
        $this->db->update('pages', $data['data'], $data['condition']);
    }

    /**
     * method getLanguages
     * @return array languages
     */

    public function getLanguages(): array
    {
        return $this->config->getMultilanguage() ? $this->config->getLanguages() : [$this->config->getDefaultLanguage() => $this->config->getLanguages()[$this->config->getDefaultLanguage()]];
    }

    /**
     * method getLinks
     * @return array Links (url pages)
     */

    public function getLinks(): array
    {
        $links = [];
        $sql = 'SELECT title, url FROM pages WHERE language_code=? AND url!=?';
        $param = [$this->session->get('language', 'code'), ""];
        $this->db->select($sql, $param);
        $rc = $this->db->getRows();
        foreach ($rc as $key => $value) {
            $links[$key] = ['title' => $value['title'], 'value' => $value['url']];
        }
        return $links;
    }

    /**
     * method createPages
     * @return array version pages languages
     */

    public function createPage(): array
    {
        if ($this->db->insert('pages', ['language_code' => $this->config->getDefaultLanguage(), 'authorName' => $this->session->get('user', 'username')])) {
            $groupId = $this->db->lastId();
            $this->db->update('pages', ['group_id' => $groupId], ['id' => $groupId]);
            foreach ($this->config->getLanguages() as $code => $name) {
                if ($this->config->getDefaultLanguage() !== $code) {
                    $this->db->insert('pages', ['language_code' => $code, 'group_id' => $groupId, 'authorName' => $this->session->get('user', 'username')]);
                }
            }
        }
        return $this->getVersionsPages($groupId);
    }

    /**
     * method getVersionsPages
     * @return array version pages languages
     */

    public function getVersionsPages($groupId): array
    {
        $pages = [];
        $sql = 'SELECT * FROM pages WHERE group_id=?';
        $param = [$groupId];
        $this->db->select($sql, $param);
        if ($this->db->numRows() > 0) {
            $rc = $this->db->getRows();
            foreach ($rc as $key => $page) {
                $pages[$page['language_code']] = $page;
            }
            return $pages;
        } else {
            return [
                'status' => false
            ];
        }
    }

    /**
     * method processSave
     * @param array data from form
     * @return array status false || true
     */

    public function processSave($formData): array
    {
        if (isset($formData['data']['title'])) {
            $formData['data']['url'] = $this->createSlug($formData['data']['title']);
        } else if (isset($formData['data']['homepage'])) {
            $this->db->update('pages', ['homepage' => 0], ['homepage' => 1]);
        }

        if ($this->db->update('pages', $formData['data'], $formData['condition'])) {
            return ['status' => true];
        }
        return ['status' => false];
    }

    /**
     * method getDeleteMessageConfirm
     * @return arrray message
     */

    public function getDeleteMessageConfirm(): array
    {
        return ['confirm' => $this->translations->translateText('delete_item?')];
    }

    /**
     * processDelete
     * delete page
     * @param integer id page
     * @return array url for reload
     */

    public function processDelete(array $condition): array
    {
        if ($this->db->delete('pages', $condition)) {
            return ['location' => $this->link->get('admin', 'pages', null, null)];
        }
    }

    /**
     * method createSlug
     * create url from title
     * @param string title
     * @return string url
     */

    private function createSlug(string $string): string
    {
        $string = strtr($string, $this->translations->getTableDiacritic());
        $string = mb_strtolower($string, 'UTF-8');
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^a-z0-9-]/', '', $string);
        return $string;
    }
}
