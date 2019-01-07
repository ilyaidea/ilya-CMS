<?php
/**
 * Summary File Controller
 *
 * Description File Controller
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 5:15 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc;

use Lib\Assets\Minify\CSS;
use Lib\Authenticates\Auth;
use Lib\Contents\ContentBuilder;
use Lib\Flash\Session;
use Lib\Tag;
use Phalcon\Mvc\Model\Transaction\Manager;

/**
 * @property CSS cssmin
 * @property Helper helper
 * @property Manager $transactions
 * @property Session $flash
 * @property ContentBuilder $content
 * @property Auth $auth
 * @property Tag $tag
 */
class Controller extends \Phalcon\Mvc\Controller
{
    private $fragmentFromGetRequest;
    private $parentIdFromGetRequest;

    public function initialize()
    {
        $this->parentIdFromGetRequest = $this->request->get('parent');
        $this->fragmentFromGetRequest = $this->request->get('fragment');

        $this->addAssetsTheme();

        if(method_exists($this, 'init'))
            $this->init();
    }

    public function setEnviroment($theme = 'frontend', $layout = null)
    {
        $this->view->setMainView(THEME_PATH. $theme. '/theme');
        $this->view->setLayoutsDir(THEME_PATH. $theme. '/layouts/');
        $this->view->setPartialsDir(THEME_PATH. $theme. '/partials/');
        $this->view->setLayout($layout);
    }

    public function addAssetsTheme()
    {
        if(file_exists(dirname($this->view->getMainView()). '/assets/css/styles.css'))
        {
            $this->content->assets->addCss('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles.css');
        }

        $this->content->assets->addJs('assets/jquery/dist/jquery.min.js');

        if(file_exists(dirname($this->view->getMainView()). '/assets/js/ilya-global.js'))
        {
            $this->content->assets->addJs('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/js/ilya-global.js');
        }
        if(file_exists(dirname($this->view->getMainView()). '/assets/js/ilya-core.js'))
        {
            $this->content->assets->addJs('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/js/ilya-core.js');
        }

        if(
            file_exists(dirname($this->view->getMainView()). '/assets/css/styles-rtl.css') &&
            $this->helper->isRTL()
        )
        {
            $this->content->assets->addCss('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles-rtl.css');
        }
    }

    public function redirect($url, $code = 302)
    {
        switch ($code) {
            case 301:
                header('HTTP/1.1 301 Moved Permanently');
                break;
            case 302:
                header('HTTP/1.1 302 Moved Temporarily');
                break;
        }
        header('Location: ' . $url);
        $this->response->send();
    }

    /**
     * @return mixed
     */
    public function getFragmentFromGetRequest()
    {
        return $this->fragmentFromGetRequest;
    }

    /**
     * @return mixed
     */
    public function getParentIdFromGetRequest()
    {
        return $this->parentIdFromGetRequest;
    }

}