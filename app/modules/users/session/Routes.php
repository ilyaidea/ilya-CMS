<?php
/**
 * Summary File Routes
 *
 * Description File Routes
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 6:51 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session;


use Lib\Mvc\DefaultRouter;

class Routes
{
    public function init(DefaultRouter $router)
    {
        $router->add(
            '/register(/|)',
            [
                'module' => 'session',
                'controller' => 'signup',
                'action' => 'index'
            ]
        );
        return $router;
    }
}