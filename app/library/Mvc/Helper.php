<?php
/**
 * Summary File Helper
 *
 * Description File Helper
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/14/2018
 * Time: 8:32 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc;

use Lib\Common\ModuleName;
use Lib\Mvc\Helper\Meta;
use Lib\Mvc\Helper\SidebarMenu;
use Lib\Mvc\Helper\Title;
use Lib\Widget\Proxy;
use Phalcon\Mvc\User\Component;

class Helper extends Component
{
    public function title($title = null, $h1 = false)
    {
        return Title::getInstance($title, $h1);
    }

    public function meta()
    {
        return Meta::getInstance();
    }

    public function sidebarMenu()
    {
        return SidebarMenu::getInstance();
    }

    public function widget($catModule, $moduleName, $params = [])
    {
        return new Proxy($catModule, $moduleName, $params);
    }

    public function modulePartial($template, $data, $category, $module = null)
    {
        $view = clone $this->getDi()->get('view');
        $partialsDir = '';
        if ($module) {
            $moduleName = ModuleName::camelize($module);
            $partialsDir = APP_PATH. 'modules/'.strtolower($category).'/' . $moduleName . '/views/';
        }
        $view->setPartialsDir($partialsDir);

        return $view->partial($template, $data);
    }
}