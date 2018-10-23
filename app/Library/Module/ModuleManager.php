<?php
/**
 * Summary File ModuleManager
 *
 * Description File ModuleManager
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/4/2018
 * Time: 2:22 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Module;


use Lib\Common\UtilMetaData;
use Lib\Di\ModuleServices;
use Lib\Mvc\Application;
use Phalcon\Loader;
use Phalcon\Mvc\User\Module;
use Phalcon\Text;

class ModuleManager extends Module
{
    private $modulePath;
    private $moduleName;
    private $moduleNamespace;

    public function __construct()
    {
        $reflection = new \ReflectionObject($this);

        $this->modulePath = dirname($reflection->getFileName());
        $this->moduleName = strtolower(basename($this->modulePath));
        $this->moduleNamespace = $reflection->getNamespaceName();

    }

    public function registerAutoloaders()
    {
        $loader = new Loader();
        $loader->registerNamespaces([
            $this->moduleNamespace                  => $this->modulePath,
            $this->moduleNamespace. '\\Controllers' => $this->modulePath.'/Controllers/',
            $this->moduleNamespace. '\\Models'      => $this->modulePath.'/Models/',
            $this->moduleNamespace. '\\Forms'       => $this->modulePath.'/Forms/',
            $this->moduleNamespace. '\\Lib'         => $this->modulePath.'/Lib/',
        ])->register();

        return $loader;
    }

    public function registerservices()
    {
        $serviceClass = $this->moduleNamespace. '\\Services';
        if(!class_exists($serviceClass))
        {
            return new ModuleServices($this->modulePath, $this->moduleNamespace);
        }
        return new $serviceClass($this->modulePath, $this->moduleNamespace);
    }

    public static function getAllControllers($modulePath, $namespace = null)
    {
        $controllers = [];

        foreach(glob($modulePath. '/Controllers/*Controller.php') as $controller)
        {
            if($namespace)
            {
                $controllers[] = $namespace. '\Controllers\\' . basename($controller, '.php');
            }
            else
            {
                $controllers[] = basename($controller, '.php');
            }
        }

        return $controllers;
    }

    /**
     * Summary Function getAllActions
     *
     * Description Function getAllActions
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $controllerClass
     * @return array
     * @throws \ReflectionException
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public static function getAllActions( $controllerClass)
    {
        $methods = (new \ReflectionClass($controllerClass))->getMethods(\ReflectionMethod::IS_PUBLIC);

        $actions = [];
        foreach($methods as $method)
        {
            if(Text::endsWith($method->name, 'Action'))
            {
                $actions[] = str_replace('Action', '', $method->name);
            }
        }

        return $actions;
    }

    public static function convertControllerNameToControllerClass($controllerName, $namespace)
    {
        $controller = ucfirst($controllerName). 'Controller';
        $controllerClass  = $namespace. '\Controllers\\'. $controller;

        return $controllerClass;
    }

    public static function listWidgetsInfo()
    {
        $widgets = [];

        $metadataUtil = new UtilMetaData();
        foreach(Application::getAllModules() as $module)
        {
            $namespace = substr($module['className'],0,strrpos($module['className'],'\\'));
            if(!file_exists(dirname($module['path']). '/Widgets'))
                continue;

            foreach(glob(dirname($module['path']). '/Widgets/*.php') as $widgetPath)
            {
                $widgetName = str_replace('.php', '', substr($widgetPath, strrpos($widgetPath, '/') + 1));
                $widgetNamespace = $namespace. '\Widgets\\'. $widgetName;
                $widgets[$widgetNamespace]['namespace'] = $widgetNamespace;
                $widgets[$widgetNamespace]['path'] = $widgetPath;

                // limit plugin parsing to first 8kB
                $contents = file_get_contents($widgetPath, false, null, 0, 8192);
                $metadata = $metadataUtil->addonMetadata($contents, 'Widget');

                $widgets[$widgetNamespace] = array_merge($widgets[$widgetNamespace], $metadata);
            }
        }

        return $widgets;
    }
}