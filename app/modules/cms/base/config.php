<?php
/**
 * Summary File ${NAME}
 *
 * Description File ${NAME}
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/13/2018
 * Time: 5:41 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

return new \Phalcon\Config([
    'name'      => basename(__DIR__),
    'path'       => __DIR__,
    'namespace' => 'Modules\\'. ucfirst(basename(dirname(__DIR__))). '\\'. ucfirst(basename(__DIR__)),

    // for sidebar menu and sub menu
    'sidebarMenu' => [
        [
            'title'      => 'titll',
            'controller' => 'index',
            'action'     => 'index'
        ]
    ],
]);