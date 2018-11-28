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
use Lib\Contents\ContentBuilder;

/**
 * @property CSS cssmin
 * @property Helper helper
 */
class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * @var ContentBuilder $content
     */
    public $content;

    public function initialize()
    {
        $this->content = ContentBuilder::instantiate();

//        $this->addAssetsTheme();
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

        $this->content->assets->addJs('ilya-theme/base/assets/js/jquery.min.js');
        if(file_exists(dirname($this->view->getMainView()). '/assets/js/ilya-global.js'))
        {
            $this->content->assets->addJs('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/js/ilya-global.js');
        }

        if(
            file_exists(dirname($this->view->getMainView()). '/assets/css/styles-rtl.css') &&
            $this->helper->isRTL()
        )
        {
            $this->content->assets->addCss('ilya-theme/'. basename(dirname($this->view->getMainView())). '/assets/css/styles-rtl.css');
        }
    }
}