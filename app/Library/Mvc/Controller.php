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


use Lib\Mvc\Helper\Content\ContentBuilder;

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
        if(file_exists(dirname($this->view->getMainView()). '/assets/css/styles.css'))
        {
            ContentBuilder::getInstance()->getContent()->addCss($this->url->getStaticBaseUri(). 'ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles.css');
        }

        if(
            file_exists(dirname($this->view->getMainView()). '/assets/css/styles-rtl.css') &&
            $this->helper->isRTL()
        )
        {
            ContentBuilder::getInstance()->getContent()->addCss($this->url->getStaticBaseUri(). 'ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles-rtl.css');
        }
    }
}