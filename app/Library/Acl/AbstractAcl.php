<?php
/**
 * Summary File AbstractAcl
 *
 * Description File AbstractAcl
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 7:07 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Acl;


use Lib\Module\ModuleManager;
use Lib\Mvc\Model\Roles\ModelRoles;
use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;

class AbstractAcl extends Memory implements IAcl
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

    public function addRolesAndAllow($namespace)
    {
        /*
         * باید وظیفه کوئری همه نقش ها و منابع مربوط به هر ماژول
         * رو به خودش بسپارم.
         */

        $roles = ModelRoles::findAllExceptByName('admin');

        foreach($roles as $role)
        {
            if($role->parent_id)
            {
                $this->addRole(
                    new Role($role->name, $role->description),
                    $role->parent->name
                );
            }
            else
            {
                $this->addRole(
                    new Role($role->name, $role->description)
                );
            }

            $namespace = str_replace('\\', '\\\\\\', $namespace);
            $resources = $role->getResources([
                'conditions' => "controller LIKE :namespace:",
                'bind' => [
                    'namespace' => "$namespace%"
                ]
            ]);

            if(!empty($resources->toArray()))
            {
                foreach($resources as $resource)
                {
                    // later check if exist resource after allow
                    $this->allow($role->name, $resource->controller.$resource->action, $resource->action);
                }
            }
        }
    }

    /**
     * The task is to add Controllers Array to resources for ACL
     *
     * @param array $controllers
     */
    public function addResourcesForControllerClass( $controllers )
    {
        foreach($controllers as $controller)
        {
            foreach(ModuleManager::getAllActions($controller) as $action)
            {
                $this->addResource(new Acl\Resource($controller.$action), $action);
            }
        }
    }
}