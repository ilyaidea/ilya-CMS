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

namespace Modules\System\Upload;


use Lib\Mvc\DefaultRouter;

class Routes
{
    public function __construct ( DefaultRouter $router )
    {
        $router->add(
            '/file/([0-9]+\.[a-z0-9]+)',
            [
                'module'     => 'upload',
                'controller' => 'index',
                'action'     => 'index',
                'blob'    => 1,
            ]
        )->setName( 'download_file' );

        $router->add(
            '/file/thumbnail/([0-9]+\.[a-z0-9]+)',
            [
                'module'     => 'upload',
                'controller' => 'index',
                'action'     => 'thumb',
                'blob'    => 1
            ]
        )->setName( 'download_file_thumb' );

        return $router;
    }
}