<?php
/**
 * Created by PhpStorm.
 * @author  Faeze Eshaghi - Farzane Rafieei
 * Date: 8/6/2018
 * Time: 9:40 AM
 */

namespace Modules\Publishing\Store;

use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
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
        $loader->registerNamespaces([
            'Modules\Publishing\Store\Controllers' => MODULE_PATH. 'Publishing/Store/controllers/',
            'Modules\Publishing\Store\Models'      => MODULE_PATH. 'Publishing/Store/models/',
            'Modules\Publishing\Store\Forms'       => MODULE_PATH. 'Publishing/Store/forms/',
            'Modules\Publishing\Store\Lib'         => MODULE_PATH. 'Publishing/Store/library/',
        ])->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        // TODO: Implement registerServices() method.
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $eventManager = new Manager();

            $dispatcher->setEventsManager($eventManager);
            $dispatcher->setDefaultNamespace('Modules\Publishing\Store\Controllers\\');
            return $dispatcher;
        });
        $di->set('view' , $this->setView($di));
    }

    private function setView(\Phalcon\DiInterface $di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setMainView(__DIR__. '/views/theme');
        $view->setLayoutsDir(__DIR__. '/views/layouts/');
        $view->setLayout( 'main');
        $view->setPartialsDir(__DIR__. '/views/partials/');

        return $view;
    }
}