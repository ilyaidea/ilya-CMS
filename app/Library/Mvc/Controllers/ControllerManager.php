<?php
/**
 * Summary File ControllerManager
 *
 * Description File ControllerManager
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 11:28 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Controllers;


use Lib\Common\Strings;

abstract class ControllerManager
{
    public static function convertControllerNameToControllerClassByModuleNamespace($controllerName, $moduleNamespace)
    {
        if(!Strings::IsEndBy($controllerName, 'Controller', true))
        {
            $controllerName = ucfirst($controllerName). 'Controller';
        }

        $controllerClass  = $moduleNamespace. '\Controllers\\'. $controllerName;

        return $controllerClass;
    }
}