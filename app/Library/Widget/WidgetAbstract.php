<?php
/**
 * Summary File AbstractWidget
 *
 * Description File AbstractWidget
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/5/2018
 * Time: 5:21 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Widget;

use Lib\Mvc\Helper;
use Phalcon\Text;

/**
 * @property Helper helper
 */
class WidgetAbstract extends \Phalcon\Mvc\User\Component
{
    private $module;

    public function run($params = null)
    {
        $partial = Text::uncamelize(
            str_replace('Widget', '', substr(get_class($this), strrpos(get_class($this), '\\') + 1)),
            '-'
        );
        $this->widgetPartial( $partial, $this->init($params));
    }

    public function widgetPartial($template, $data = [])
    {
        $this->helper->modulePartial($template, $data, $this->module);
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    protected function init()
    {
        return [];
    }
}