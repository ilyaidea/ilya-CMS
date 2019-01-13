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
use Lib\Mvc\Model\Users\ModelUsers;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\View;

class Acl extends Plugin
{
    public function __construct(Memory $acl, Dispatcher $dispatcher, View $view)
    {
        $role = $this->getRole();

        $resourceKey = $dispatcher->getControllerClass();
        $resourceVal = $dispatcher->getActionName();

        if($acl->isResource($resourceKey))
        {
            if(!$acl->isAllowed($role, $resourceKey, $resourceVal))
            {
                $this->accessDenied($view, $resourceKey);
            }
        }
        else
        {
            $this->resourceNotFined($view, $resourceKey);
        }
    }

    public function getRole()
    {
        $session = $this->session->get('auth');

        if($session)
        {
            $id = $session->id;
            $user = ModelUsers::findFirstById($id);

            $role = $user->getRole();
        }
        else
        {
            $role = 'admin';
        }

        return $role;
    }

    private function resourceNotFined(View $view, $resourceKey)
    {
        $view->setViewsDir(THEME_PATH. 'errors/');
        $view->setPartialsDir('partials/');
        $view->message = "این راه به جایی نمیرسد.";
        $view->partial('error404');

        $response = new Response();
        $response->setHeader(404, 'Not Found');
        $response->sendHeaders();
        echo $response->getContent();

        exit;
    }

    private function accessDenied(View $view, $resourceKey)
    {
        $view->setViewsDir(THEME_PATH. 'errors/');
        $view->setPartialsDir('partials/');
        $view->message = "شما دسترسی به پیج را ندارید.";
        $view->partial('error404');

        $response = new Response();
        $response->setHeader(403, 'Forbidden');
        $response->sendHeaders();
        echo $response->getContent();

        exit;
    }
}