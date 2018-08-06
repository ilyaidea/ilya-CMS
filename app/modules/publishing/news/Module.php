<?php
/**
 * Summary File Module
 *
 * Description File Module
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/6/2018
 * Time: 9:21 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Publishing\News;

use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

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
            'Modules\Publishing\News\Controllers'  => MODULE_PATH . 'publishing/news/controllers',
            'Modules\Publishing\News\Models'       => MODULE_PATH . 'publishing/news/models',
            'Modules\Publishing\News\Forms'        => MODULE_PATH . 'publishing/news/forms',

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
        $di->set('dispatcher', function ()
        {
            $dispatcher = new Dispatcher();
            $eventManager = new Manager();

            $dispatcher->setEventsManager($eventManager);
            $dispatcher->setDefaultNamespace('Modules\Publishing\News\Controllers\\');
            return $dispatcher;
        });
        $di->set('view',$this->setView($di));

    }
    private function setView(\Phalcon\DiInterface $di)
    {


        $view = $di->get('view');
        $view->setMainView(__DIR__.'/views/theme');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setLayoutsDir(__DIR__.'/views/layouts/');
        $view->setLayout('main');
        $view->setPartialsDir(__DIR__.'/views/partials/');


        return $view;
    }
}