<?php
/**
 * Summary File Routes
 *
 * Description File Routes
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/9/2018
 * Time: 6:14 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session;


use Lib\Mvc\DefaultRouter;

class Routes
{
    public function __construct(DefaultRouter $router)
    {
        $router->add(
            '/',
            [
                'module' => 'session',
                'controller' => 'index',
                'action' => 'index'
            ]
        )->setName('home');

        $router->add(
            '/logout',
            [
                'module' => 'session',
                'controller' => 'logout',
                'action' => 'index'
            ]
        )->setName('logout');

        return $router;
    }
}