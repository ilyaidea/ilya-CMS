<?php
/**
 * Created by PhpStorm.
 * @author  Faeze Eshaghi - Farzane Rafieei
 * Date: 8/6/2018
 * Time: 9:58 AM
 */

namespace Modules\Publishing\Store;

use Lib\Mvc\DefaultRouter;

class Routes
{
    Public function init(DefaultRouter $router)
    {
//        $router->add(
//            '/store/(/?|)',
//            [
//                'module' => 'publishing',
//                'contoroller' => 'index',
//            ]
//            );
        return $router;
    }
}