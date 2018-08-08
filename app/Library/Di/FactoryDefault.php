<?php
/**
 * Summary File FactoryDefault
 *
 * This factorydefault was created to Instead of using the service directly from phalcons factorydefault,
 * Use this factorydefault.
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/9/2018
 * Time: 11:35 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Di;

class FactoryDefault extends \Phalcon\Di\FactoryDefault
{
    /**
     *when this factorydefault run,first this fanction  runs her father's features(phalcons factorydefault).
     * @param $config
     */
    public function __construct($config)
    {
        parent::__construct();

        $this->setShared('config', $config);
        $this->bindServices();
    }

    /**
     * Summary Function bindServices
     *
     * this function gives all metodes of factorydefault and services.
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    private function bindServices()
    {
        $reflection = new \ReflectionObject($this);

        foreach ($reflection->getMethods() as $method)
        {
            $this->condForUseSetOrSetSharedMethod($method);
        }
    }

    /**
     * Summary Function condForUseSetOrSetSharedMethod
     *
     * Description Function condForUseSetOrSetSharedMethod
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $method
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function condForUseSetOrSetSharedMethod($method)
    {
        if ($this->isMethodNameStart($method->name, 10, 'initShared'))
        {
            $this->setShared(lcfirst(substr($method->name, 10)), $method->getClosure($this));
        }
        elseif ($this->isMethodNameStart($method->name, 4, 'init'))
        {
            $this->set(lcfirst(substr($method->name, 4)), $method->getClosure($this));
        }
    }

    /**
     * Summary Function isMethodNameStart
     *
     * Description Function isMethodNameStart
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $name
     * @param $maxLenght
     * @param $needle
     * @return bool
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function isMethodNameStart($name, $maxLenght, $needle)
    {
        if ((strlen($name) > $maxLenght) && (strpos($name, $needle) === 0))
        {
            return true;
        }

        return false;
    }
}