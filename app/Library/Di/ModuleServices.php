<?php
/**
 * Summary File Services
 *
 * Description File Services
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/4/2018
 * Time: 11:04 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Di;


use Lib\Acl\DefaultAcl;
use Lib\Module\ModuleManager;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Config;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Component;

class ModuleServices extends Component
{
    private $namespace;
    private $path;
    private $moduleName;

    public function __construct($path, $namespace = null)
    {
        $this->path = $path;

        $reflection = new \ReflectionObject($this);

        if($namespace)
        {
            $this->namespace = $namespace;
        }
        else
        {
            $this->namespace = $reflection->getNamespaceName();
        }

        $this->moduleName = strtolower(basename(($this->path)));
        $this->getDI()->setShared('config', $this->setConfig($path));

        $this->bindServices($reflection);
    }

    protected function setConfig($path)
    {
        $coreConfig = $this->getDI()->getShared('config');

        $defaultConfig = new Config([
            'module' => [
                'name' => $this->moduleName,
                'path' => $this->path,
                'namespace' => $this->namespace,
            ]
        ]);

        /** @var Config $coreConfig */
        $coreConfig = $coreConfig->merge($defaultConfig);
        if(file_exists($path. '/config/config.php'))
        {
            $moduleConfig = require_once $path. '/config/config.php';

            /** @var Config $coreConfig */
            $coreConfig['module'] = $coreConfig['module']->merge($moduleConfig);
        }

        return $coreConfig;
    }

    private function bindServices($reflection)
    {
        $this->getDI()->setShared('acl', $this->setAcl());
        $this->getDI()->setShared('dispatcher', $this->setDispatcher());
        $this->getDI()->setShared('view', $this->setView());

        foreach ($reflection->getMethods() as $method)
        {
            $this->condForUseSetOrSetSharedMethod($method);
        }
    }

    protected function setDispatcher()
    {
        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->getDI()->getShared('dispatcher');

        /** @var Manager $eventManager */
        $eventManager = $this->getDI()->getShared('manager');

        $dispatcher->setEventsManager($eventManager);
        $dispatcher->setDefaultNamespace($this->namespace. '\Controllers\\');
        return $dispatcher;
    }

    protected function setAcl()
    {
        /** @var DefaultAcl $acl */
        $acl = $this->getDI()->getShared( 'acl' );

        $aclPath = $this->path. '/config/acl.php';

        $controllers = ModuleManager::getAllControllers($this->path, $this->namespace);

        $acl->addResourcesForControllerClass($controllers);

        if(!file_exists($aclPath))
        {
            return $acl;
        }

        $roles = [];

        $resources = require_once $aclPath;

        $acl->addRolesAndAllow($resources, $this->namespace);

        return $acl;
    }

    private function setView()
    {
        $view = $this->getDI()->getShared('view');
        $view->setViewsDir($this->path. '/views/');
        return $view;
    }

    protected function condForUseSetOrSetSharedMethod(\ReflectionMethod $method)
    {
        if ($this->isMethodNameStart($method->name, 10, 'initShared'))
        {
            $method->invoke($this, $this->getDI());
            $this->getDI()->setShared(lcfirst(substr($method->name, 10)), $method->getClosure($this));
        }
        elseif ($this->isMethodNameStart($method->name, 4, 'init'))
        {
            $method->invoke($this, $this->getDI());
            $this->getDI()->set(lcfirst(substr($method->name, 4)), $method->getClosure($this));
        }
    }

    /**
     * Summary Function isMethodNameStart
     *
     * Description Function isMethodNameStart
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $name
     * @param $maxLenght
     * @param $needle
     * @return bool
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function isMethodNameStart($name, $maxLenght, $needle)
    {
        if ((strlen($name) > $maxLenght) && (strpos($name, $needle) === 0))
        {
            return true;
        }

        return false;
    }


}