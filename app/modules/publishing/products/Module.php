<?php
/**
 * Created by PhpStorm.
 * User: farzan
 * Date: 8/6/2018
 * Time: 9:37 AM
 */
namespace Modules\Publishing\Products ;

use Lib\Mvc\View\Engine\Volt;
use Phalcon\Events\Event;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'Modules\Publishing\Products\Controllers' => MODULE_PATH.'publishing/products/controllers',
                'Modules\Publishing\Products\Forms' => MODULE_PATH.'publishing/products/forms',
                'Modules\Publishing\Products\Model' => MODULE_PATH.'publishing/products/model',
            ]

        )->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        // TODO: Implement registerServices() method.
        $di->set('dispatcher' , function ()
        {
            $dispatcher = new Dispatcher();
            $eventManager = new Manager();
            $dispatcher->setEventsManager($eventManager);
            $dispatcher->setDefaultNamespace('Modules\Publishing\Products\Controllers\\');
            return $dispatcher ;
        });
        $di->set('view' , $this->setView($di));
    }

    private function setView(\Phalcon\DiInterface $di)
    {
        $view = $di->get('view');
        $view->setMainView(__DIR__. '/views/theme');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setLayoutsDir(__DIR__. '/layouts/');
        $view->setLayout('main');
        $view->setPartialsDir(__DIR__. '/partials/');
        return $view;
    }
}