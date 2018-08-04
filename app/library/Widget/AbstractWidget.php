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

class AbstractWidget extends \Phalcon\Mvc\User\Component
{
    private $module;
    private $category;

    public function widgetPartial($template, $data = [])
    {
        $this->helper->modulePartial($template, $data, $this->category, $this->module);
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}