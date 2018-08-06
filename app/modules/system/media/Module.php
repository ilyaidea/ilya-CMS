<?php
/**
 * Created by PhpStorm.
 * User: reza
 * Date: 06/08/2018
 * Time: 09:28 AM
 */

namespace Modules\System\Media;

use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'Modules\System\Media\Controllers' => MODULE_PATH . 'system/media/controllers',
                'Modules\System\Media\Forms'       => MODULE_PATH . 'system/media/forms',
                'Modules\System\Media\Models'      => MODULE_PATH . 'system/media/models'

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
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $eventManager = new Manager();

            $dispatcher->setEventsManager($eventManager);
            $dispatcher->setDefaultNamespace('Modules\System\Media\Controllers\\');
            return $dispatcher;
        });
        $di->set('view', $this->setView($di));
    }

    private function setView(\Phalcon\DiInterface $di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setMainView(__DIR__. '/views/theme');
        $view->setLayoutsDir(__DIR__. '/views/layouts/');
        $view->setPartialsDir(__DIR__. '/views/partials/');
        $view->setLayout('main');

        return $view;

    }
}