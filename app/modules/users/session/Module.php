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
            'Modules\Users\Session\Controllers' => MODULE_PATH. 'users/session/controllers/',
            'Modules\Users\Session\Models'      => MODULE_PATH. 'users/session/models/',
            'Modules\Users\Session\Forms'       => MODULE_PATH. 'users/session/forms/',
            'Modules\Users\Session\Lib'         => MODULE_PATH. 'users/session/library/',
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
            $dispatcher->setDefaultNamespace('Modules\Users\Session\Controllers\\');
            return $dispatcher;
        });
        $di->set('view' , $this->setView($di));
    }

    private function setView(\Phalcon\DiInterface $di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        return $view;
    }
}