<?php
/**
 * Summary File Application
 * Application Class and it's Methods Definition
 * Description File Application
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 10:10 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc;

class Application extends \Phalcon\Mvc\Application
{
    /**
     * Application constructor.
     * Loads the modules and initializes their routs
     * @param \Phalcon\DiInterface|null $di
     */
    public function __construct(\Phalcon\DiInterface $di = null)
    {
        parent::__construct($di);
        $this->registerModules(self::getAllModules());
        $this->initRoute($di);
    }

    /**
     * Summary Function getAllModules
     * Returns all modules that located in \Lib\Common\Directory
     * @return array
     */
    public static function getAllModules()
    {
        $modules = [];

        foreach (\Lib\Common\Directory::getSubDirs(APP_PATH. 'modules/*') as $modulePath)
        {
            foreach (\Lib\Common\Directory::getSubDirs($modulePath. '/*') as $module)
            {
                $modules[lcfirst(basename($module))] = [
                    'className' => 'Modules\\'. ucfirst(basename($modulePath)). "\\". ucfirst(basename($module)). '\Module',
                    'path'      => $module. '/Module.php'
                ];
            }
        }

        return $modules;
    }

    /**
     * Summary Function initRoute
     * Sets the modules Routs
     * @param \Phalcon\DiInterface $di
     */
    private function initRoute(\Phalcon\DiInterface $di)
    {
        $router = new \Lib\Mvc\DefaultRouter();

        foreach ($this->getModules() as $module)
        {
            $this->registerModulesRoutesClass($module, $router);
            $this->registerModulesInitClass($module);
        }
        $router->setDi($di);
        $di->set('router', $router);
    }

    /**
     * @param $module
     * @param $router
     * @return mixed
     */
    private function registerModulesRoutesClass($module, $router)
    {
        $routesClassName = str_replace('\Module', '\Routes', $module['className']);

        if (file_exists(str_replace('Module.php', 'Routes.php', $module['path'])))
        {
            include_once str_replace('Module.php', 'Routes.php', $module['path']);
            if (class_exists($routesClassName))
            {
                $routesClass = new $routesClassName();
                return $routesClass->init($router);
            }
        }
    }

    /**
     * @param $module
     */
    private function registerModulesInitClass($module)
    {
        $initClassName = str_replace('\Module', '\Init', $module['className']);
        if (is_dir(str_replace('Module.php', 'Init.php', $module['path'])))
        {
            include str_replace('Module.php', 'Init.php', $module['path']);
            if (class_exists($initClassName)) {
                new $initClassName();
            }
        }
    }
}