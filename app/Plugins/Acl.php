<?php
/**
 * Summary File Acl
 *
 * Description File Acl
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 9/29/2018
 * Time: 5:51 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Plugins;


use Ilya\Models\Users;
use Lib\Acl\DefaultAcl;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class Acl extends Plugin
{
    public function __construct(Memory $acl, Dispatcher $dispatcher)
    {
        $role = $this->getRole();

        $moduleName = $dispatcher->getModuleName();
        $controllerName = $dispatcher->getControllerName();
        $actionName = $dispatcher->getActionName();

//        echo "Role => ". $role. '<br>';
//        echo $moduleName. '/'. $controllerName. '/'. $actionName. "<br>";
//
//        if($acl->isAllowed($role, $moduleName. '/'. $controllerName, $actionName))
//        {
//            die('is Allowed');
//        }
//        else
//        {
//            die('dont Allowed');
//        }

//        die( $moduleName. '/'. $controllerName. '/'. $actionName);
//        echo "<br>";
    }

    public function getRole()
    {
        $session = $this->session->get('auth');

        if($session)
        {
            $id = $session->id;
            $user = Users::findFirstById($id);

            $role = $user->getRole();
        }
        else
        {
            $role = 'guest';
        }

        return $role;
    }
}