<?php

namespace library;

class Page
{
    private $environment;
    private $content = 'Content Page';
    private $info = [];
    private $views = [];
    private $postParseViews = [];
    private $css = [];
    private $js = [];
    private $jsController;

    /**
     * Method setContent
     * 
     * Saves the content of the page
     * 
     * @param string content page
     */

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Method getContent
     * 
     * Returns the content of the page
     * 
     * @return string content page
     */

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Method setEnvironment
     * 
     * Saves the environment of the page
     * 
     * @param string content page
     */

    public function setEnvironment(string $environment): void
    {
        $this->environment = $environment;
    }

    /**
     * Method getEnvironment
     * 
     * Returns the environment of the page
     * 
     * @return string environment page
     */

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * Method setInfo
     * 
     * Saves the url, title, description, keywords of the page
     * 
     * @param array info page
     */

    public function setInfo(array $info): void
    {
        $this->info = $info;
    }

    /**
     * Method getTitle
     * 
     * Returns the url, title, description, keywords of the page
     * 
     * @return array info page
     */

    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Method setViews
     * 
     * Saves the view of the page
     * 
     * They will be used in the first parsing
     * 
     * @param string tag
     * @param string $view
     */

    public function setView(string $tag, string $view): void
    {
        $this->views[$tag] = $view;
    }

    /**
     * Method getView
     * 
     * Returns the views of the page
     * 
     * @return array views
     */

    public function getViews(): array
    {
        return $this->views;
    }

    /**
     * Method setPostParseView
     * 
     * Saves the view of the page
     * 
     * They will be used in the second parsing
     * 
     * @param string tag
     * @param string $view
     */

    public function setPostParseView(string $tag, string $view): void
    {
        $this->postParseViews[$tag] = $view;
    }

    /**
     * Method getPostParseView
     * 
     * Returns the view of the page
     * 
     * @return array postParseViews
     */

    public function getPostParseView(): array
    {
        return $this->postParseViews;
    }

    /**
     * Method setCss
     * 
     * Saves the css path file
     * 
     * @param string path css files
     */

    public function setCss(string $cssPath): void
    {
        $this->css[] = $cssPath;
    }

    /**
     * Method getCss
     * 
     * Returns the array css of the page
     * 
     * @return array path css files
     */

    public function getCss(): array
    {
        return $this->css;
    }

    /**
     * Method setJs
     * 
     * Saves the javascript path file
     * 
     * @param string path javascript file
     */

    public function setJs(string $jsPath): void
    {
        $this->js[] = $jsPath;
    }

    /**
     * Method getJs
     * 
     * Returns the array javascript of the page
     * 
     * @return array path javascript file
     */

    public function getJs(): array
    {
        return $this->js;
    }

    /**
     * Method setJs
     * 
     * Saves the javascript path file for controller
     * 
     * @param string path javascript file
     */

    public function setJsController(string $jsPath): void
    {
        $this->jsController = $jsPath;
    }

    /**
     * Method getJs
     * 
     * Returns the array javascript of the controller
     * 
     * @return string path javascript file
     */

    public function getJsController(): string
    {
        return $this->jsController;
    }
}
