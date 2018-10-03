<?php
/**
 * Summary File Module
 *
 * Description File Module
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 6:50 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session;

use Lib\Di\RegisterServicesModules;
use Phalcon\DiInterface;
use Phalcon\Loader;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{
    /**
     * this function register autoloaders
     *
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders( DiInterface $di = null )
    {
        $loader = new Loader();
        $loader->registerNamespaces( [
            'Modules\Users\Session\Controllers' => MODULE_PATH.'Users/Session/Controllers/',
            'Modules\Users\Session\Models'      => MODULE_PATH.'Users/Session/Models/',
            'Modules\Users\Session\Forms'       => MODULE_PATH.'Users/Session/Forms/',
            'Modules\Users\Session\Lib'         => MODULE_PATH.'Users/Session/Lib/',
        ] )->register();
    }

    public function registerServices( DiInterface $di = null )
    {
        new RegisterServicesModules(__DIR__);

        $di->setShared( 'dispatcher', $this->setSharedDispatcher( $di ) );
        $di->setShared( 'view', $this->setSharedView( $di ) );
    }

    private function setSharedDispatcher( DiInterface $di )
    {
        $dispatcher = $di->getShared( 'dispatcher' );

        $dispatcher->setDefaultNamespace( 'Modules\Users\Session\Controllers\\' );
        return $dispatcher;
    }

    private function setSharedView( DiInterface $di )
    {
        $view = $di->getShared( 'view' );
        $view->setViewsDir( __DIR__.'/views/' );
        return $view;
    }
}