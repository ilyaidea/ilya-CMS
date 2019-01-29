<?php
namespace Lib\Acl;

use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class CheckAcl extends Plugin
{
    private $acl;
    private $dispatcher;
    private $view;

    public function __construct(AbstractAcl $acl, Dispatcher $dispatcher, View $view)
    {
        $this->acl = $acl;
        $this->dispatcher = $dispatcher;
        $this->view = $view;

        if($this->checkExistUserRolesAndExistResource())
        {
            if($this->isAllowedAccess())
            {
                dump('ACL => Access denied');
            }
        }
        else
        {
            dump('ACL => resource not found');
        }
    }

    private function getCountAccess()
    {
        $countAccess = 0;
        foreach(ModelUsers::getUserRolesForAuth() as $role)
        {
            if(!$this->acl->isAllowed(
                    $role,
                    $this->dispatcher->getControllerClass().$this->dispatcher->getActionName(),
                    $this->dispatcher->getActionName()
                )
            )
            {
                $countAccess++;
            }
        }

        return $countAccess;
    }

    private function isAllowedAccess()
    {
        if($this->getCountAccess() == count(ModelUsers::getUserRolesForAuth()))
        {
            return true;
        }

        return false;
    }

    private function checkExistUserRolesAndExistResource()
    {
        if(
            !empty(ModelUsers::getUserRolesForAuth()) &&
            $this->acl->isResource(
                $this->dispatcher->getControllerClass().
                $this->dispatcher->getActionName()
            )
        )
        {
            return true;
        }
        return false;
    }


//    private function resourceNotFined(View $view, $resourceKey)
//    {
//        $view->setViewsDir(THEME_PATH. 'errors/');
//        $view->setPartialsDir('partials/');
//        $view->message = "این راه به جایی نمیرسد.";
//        $view->partial('error404');
//
//        $response = new Response();
//        $response->setHeader(404, 'Not Found');
//        $response->sendHeaders();
//        echo $response->getContent();
//
//        exit;
//    }
//
//    private function accessDenied(View $view, $resourceKey)
//    {
//        $view->setViewsDir(THEME_PATH. 'errors/');
//        $view->setPartialsDir('partials/');
//        $view->message = "شما دسترسی به پیج را ندارید.";
//        $view->partial('error404');
//
//        $response = new Response();
//        $response->setHeader(403, 'Forbidden');
//        $response->sendHeaders();
//        echo $response->getContent();
//
//        exit;
//    }
}