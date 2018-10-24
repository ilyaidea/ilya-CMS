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

/**
 * @property CSS cssmin
 * @property Helper helper
 */
class Controller extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->tag->appendTitle("Ilya CMS | ");
        $this->tag->setTitleSeparator(" | ");

        $this->addAssetsTheme();
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
        $this->config->module->themePath = dirname($this->view->getMainView()). '/';
        $content = $this->helper->content()->getContent();
        $key = $content->getParts('key');
        if(file_exists(dirname($this->view->getMainView()). '/assets/css/styles.css'))
        {
            $content->addCss('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles.css');
        }

        if(
            file_exists(dirname($this->view->getMainView()). '/assets/css/styles-rtl.css') &&
            $this->helper->isRTL()
        )
        {
            $content->addCss('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles-rtl.css');
        }
    }

    protected function getHashKey()
    {
        return
            HOST_HASH.
            $this->dispatcher->getParam('lang').
            md5(
            $this->dispatcher->getControllerClass().
            '\\'.
            $this->dispatcher->getActionName());
    }
}