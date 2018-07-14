<?php
/**
 * Summary File ModuleName
 *
 * Description File ModuleName
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/5/2018
 * Time: 6:03 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Common;


class ModuleName
{
    public static function camelize($module)
    {
        $tmpModuleNameArr = explode('-', $module);
        $moduleName = '';
        foreach ($tmpModuleNameArr as $part) {
            $moduleName .= \Phalcon\Text::camelize($part);
        }
        return $moduleName;
    }
}