<?php
/**
 * Summary File Proxy
 *
 * Description File Proxy
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/5/2018
 * Time: 5:46 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Widget;

use Phalcon\Loader;

class Proxy extends \Phalcon\Mvc\User\Component
{
    private $object;
    private $namespace;

    public function __construct($namespace, $params = [])
    {
        $this->namespace = $namespace;

        $loader = new Loader();
        $loader->registerClasses([
            $this->namespace => APP_PATH. str_replace('\\', '/', $namespace). '.php'
        ])->register();

        $namespace = '\\'. $this->namespace;

        $modulePath = dirname(dirname(APP_PATH. str_replace('\\', '/', $namespace). '.php'));
        $this->object = new $namespace();
        $this->object->setModule($modulePath. '/');
    }

    public function __call($method, array $params)
    {
        return $this->getResults($method, $params);
    }

    private function getResults($method, $params)
    {
        ob_start();
        call_user_func_array(array($this->object, $method), $params);
        $results = ob_get_contents();
        ob_end_clean();
        return $results;

    }
}