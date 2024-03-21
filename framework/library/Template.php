<?php

namespace library;

use DI\Container;

class Template
{

    private $page;
    private $render;
    private $alerts;
    private $response;
    private $request;

    /**
     * Constructor
     * 
     * Creates objects
     * 
     * @param object Container
     */

    public function __construct(Page $page, Render $render, Alerts $alerts, Response $response, Request $request)
    {
        $this->page = $page;
        $this->render = $render;
        $this->alerts = $alerts;
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Method setEnvironmentTemplate
     * 
     * Sets the main environment template
     */

    private function setEnvironmentTemplate(): void
    {
        $content = $this->render->get('public' . DS . 'environment' . DS . $this->page->getEnvironment(), []);
        $this->page->setContent($content);
    }

    /**
     * Method setEnvironmentTemplate
     * 
     * Sets the main environment template
     */

    private function setInfoTemplate(): void
    {
        foreach ($this->page->getInfo() as $tag => $value) {
            $this->page->setContent(str_replace('<!--[' . $tag . ']-->', $value, $this->page->getContent()));
        }
    }

    /**
     * Method setViewsTemplate
     * 
     * Sets the views in template
     */

    private function setViewsTemplate(array $views): void
    {
        foreach ($views as $tag => $view) {
            $this->page->setContent(str_replace('<!--[' . $tag . ']-->', $view, $this->page->getContent()));
        }
    }

    /**
     * Method setCssTemplate
     * 
     * Sets the css block in template
     */

    private function setCssTemplate(): void
    {
        $css = '';
        foreach ($this->page->getCss() as $cssPath) {
            if (file_exists(ROOT . $cssPath . '.css')) {
                $css .= '<link rel="stylesheet" href="' . URL . $cssPath . '.css">';
            }
        }
        $this->page->setContent(str_replace('<!--[css]-->', $css, $this->page->getContent()));
    }

    /**
     * Method setJsTemplate
     * 
     * Sets the js block in template
     */

    private function setJsTemplate(): void
    {
        $js = '';
        foreach ($this->page->getJs() as $jsPath) {
            if (file_exists(ROOT . $jsPath . '.js')) {
                $js .= '<script src="' . URL . $jsPath . '.js" defer></script>';
            }
        }
        if (file_exists(ROOT . $this->page->getJsController() . '.js')) {
            $js .= '<script src="' . URL . $this->page->getJsController() . '.js" defer></script>';
        }
        $this->page->setContent(str_replace('<!--[js]-->', $js, $this->page->getContent()));
    }

    /**
     * Method setAlertsTemplate
     * 
     * Sets the alerts block in template
     */

    private function setAlertsTemplate()
    {
        if (!empty($this->alerts->get())) {
            $alertBlock = '<div class="alert-block">';
            foreach ($this->alerts->get() as $type => $alerts) {
                foreach ($alerts as $alert) {
                    $alertBlock .=
                        '<div class="alert ' . $type . ' alert-dismissible fade show text-center" role="alert">' . $alert .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
            $alertBlock .= '</div>';
            if ($this->request->get()) {
                $this->response->set(['alerts' => $alertBlock]);
            } else {
                $_SESSION['alerts'] = $alertBlock;
            }
        }
    }

    /**
     * Method printPage
     * 
     * print page or echo response for javascript
     */

    public function printPage(): void
    {
        $this->setAlertsTemplate();
        if ($this->request->get()) {
            echo json_encode($this->response->get());
            exit();
        } else {
            $this->setEnvironmentTemplate();
            $this->setInfoTemplate();
            $this->setViewsTemplate($this->page->getViews());
            $this->setCssTemplate();
            $this->setJsTemplate();
            $this->setViewsTemplate($this->page->getPostParseView());
            print($this->page->getContent());
        }
    }
}
