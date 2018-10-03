<?php
/**
 * Summary File RegisterServicesModules
 *
 * Description File RegisterServicesModules
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/2/2018
 * Time: 7:01 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Di;


use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Mvc\User\Component;

class RegisterServicesModules extends Component
{
    private $modulePath;
    private $moduleName;

    public function __construct($path)
    {
        $this->modulePath = $path;
        $this->moduleName = strtolower(basename($this->modulePath));

        if(file_exists($path. '/config/config.php'))
        {
            $config = require_once $path. '/config/config.php';
            $this->getDI()->setShared('config', $this->setShardConfig($config));
        }

        $this->getDI()->setShared( 'acl', $this->setSharedAcl() );
    }

    private function setShardConfig($config)
    {
        return $this->getDI()->getShared( 'config' )->merge( $config );
    }

    private function setSharedAcl()
    {
        /** @var Memory $acl */
        $acl = $this->getDI()->getShared( 'acl' );

        $aclPath = $this->modulePath. '/config/acl.php';

        $roles = [];

        if(!file_exists($aclPath))
        {
            return $acl;
        }

        $resources = require_once $aclPath;

        foreach($resources as $role => $resource)
        {
            $roles[$role] = new Role($role);
            $acl->addRole( new Role($role) );
            foreach($resource as $controller => $actions)
            {
                $acl->addResource($this->moduleName. '/'. $controller, $actions);
                $acl->allow($roles[$role], $this->moduleName. '/'. $controller, $actions);
            }
        }
        return $acl;
    }
}