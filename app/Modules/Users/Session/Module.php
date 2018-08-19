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

use Phalcon\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{

    /**
     * this function register autoloaders
     *
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new Loader();
        $loader->registerNamespaces([
            'Modules\Users\Session\Controllers' => MODULE_PATH. 'Users/Session/Controllers/',
            'Modules\Users\Session\Models'      => MODULE_PATH. 'Users/Session/Models/',
            'Modules\Users\Session\Forms'       => MODULE_PATH. 'Users/Session/Forms/',
            'Modules\Users\Session\Lib'         => MODULE_PATH. 'Users/Session/Library/',
        ])->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $di)
    {
        // TODO: Implement registerServices() method.
        $di->set('dispatcher', $this->setDispatcher($di));
        $di->set('view' , $this->setView($di));
    }

    private function setDispatcher(DiInterface $di)
    {
        $dispatcher = $di->get('dispatcher');

        $dispatcher->setDefaultNamespace('Modules\Users\Session\Controllers\\');
        return $dispatcher;
    }
    private function setView(DiInterface $di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        return $view;
    }
}