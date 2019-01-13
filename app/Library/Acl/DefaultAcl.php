<?php
namespace Lib\Acl;

use Lib\Module\ModuleManager;
use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;

class DefaultAcl extends Memory
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultAction(
            Acl::DENY
        );

        $this->setAdmin();
    }

    private function setAdmin()
    {
        $adminRole = new Role('admin', 'Admin role');

        $this->addRole($adminRole);

        $this->allow('admin', '*', '*');
    }

    public function addResourcesForControllerClass($controllersClass)
    {
        foreach($controllersClass as $controller)
        {
            foreach(ModuleManager::getAllActions($controller) as $action)
            {
                $this->addResource($controller, $action);
            }
        }
    }

    public function addRolesAndAllow($resources, $namespace)
    {
        $roles = [];
        foreach($resources as $role => $resource)
        {
            $roles[$role] = new Role($role);
            $this->addRole( new Role($role) );
            foreach($resource as $controller => $actions)
            {
                $controllerClass = ModuleManager::convertControllerNameToControllerClass($controller, $namespace);
                $this->allow($roles[$role], $controllerClass, $actions);
            }
        }
    }
}