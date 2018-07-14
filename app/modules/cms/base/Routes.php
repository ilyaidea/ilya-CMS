<?php
/**
 * Summary File Route
 *
 * Description File Route
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/13/2018
 * Time: 12:34 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Cms\Base;

use Lib\Mvc\DefaultRouter;

class Routes
{
    public function init(DefaultRouter $router)
    {
        $router->addForLang(
            '/:module(|/)',
            [
                'module' => basename(__DIR__),
                'controller' => 'index',
                'action'     => 'index'
            ],
            'cmslang'
        );

        return $router;
    }
}