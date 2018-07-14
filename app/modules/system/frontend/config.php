<?php
/**
 * Summary File ${NAME}
 *
 * Description File ${NAME}
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 12:00 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

return new \Phalcon\Config([
    'name'      => basename(__DIR__),
    'path'       => __DIR__,
    'namespace' => 'Modules\\'. ucfirst(basename(dirname(__DIR__))). '\\'. ucfirst(basename(__DIR__))
]);