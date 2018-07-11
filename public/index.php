<?php
/**
 * Summary File ${NAME}
 *
 * Description File ${NAME}
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:19 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__). '/');
define('APP_PATH', BASE_PATH. 'app/');
define('MODULES_PATH', APP_PATH. 'modules/');

require_once APP_PATH. 'Bootstrap.php';

$bootstrap = new \Ilya\Bootstrap();
$bootstrap->run();