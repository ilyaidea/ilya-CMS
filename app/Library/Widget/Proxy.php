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
    private $moduleName;
    private $catModule;

    public function __construct($catModule, $moduleName, $params = [])
    {
        $this->moduleName = $moduleName;
        $this->catModule = ucfirst($catModule);
        ucfirst($moduleName);
        $this->namespace = 'Modules\\'.$catModule.'\\'.$moduleName . '\\Widget';

        $loader = new Loader();
        $loader->registerNamespaces([
            $this->namespace => APP_PATH. 'modules/'.strtolower($catModule).'/' . strtolower($moduleName). '/widget'
        ])->register();

        $class = $this->namespace . '\\' . $moduleName . 'Widget';
        $this->object = new $class();
        $this->object->setModule($moduleName);
        $this->object->setCategory($this->catModule);
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