<?php
/**
 * Created by PhpStorm.
 * User: reza
 * Date: 06/08/2018
 * Time: 09:30 AM
 */

namespace Modules\System\Media;

use Lib\Mvc\DefaultRouter;

class Routes
{
    public function init(DefaultRouter $router)
    {
    $router->add(
        '/media(/|)',
        [
            'module' => 'media',
            'controller' => 'index',
            'action' => 'index'
        ]
    )->setName('system_media');


        return $router;
    }

}