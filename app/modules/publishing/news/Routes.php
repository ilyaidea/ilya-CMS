<?php
/**
 * Summary File Routes
 *
 * Description File Routes
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/6/2018
 * Time: 10:08 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Publishing\News;


use Lib\Mvc\DefaultRouter;

class Routes
{
    public function init(DefaultRouter $router)
    {
        $router->add(
            '/addnews(/|)',
            [
                'module' => 'news',
                'controller' => 'add',
                'action' => 'index'
            ]
        )->setName('publishing_news');
    }

}

