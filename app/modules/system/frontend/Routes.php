<?php
/**
 * Summary File Routes
 *
 * Description File Routes
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 11:08 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\System\Frontend;


use Lib\Mvc\DefaultRouter;

class Routes
{
    public function init(DefaultRouter $router)
    {
        $router->addForLang(
            '/:module',
            [
                'module' => basename(__DIR__),
                'controller' => 'index',
                'action'     => 'index'
            ],
            'frontend_lang'
        );

        return $router;
    }
}