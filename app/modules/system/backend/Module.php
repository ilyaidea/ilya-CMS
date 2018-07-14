<?php
/**
 * Summary File Module
 *
 * Description File Module
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/9/2018
 * Time: 5:09 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Backend;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{
    public function __construct()
    {
        echo "Backend<br>";
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces([
            'Modules\System\Backend\Controllers' => MODULE_PATH. 'system/backend/controllers/',
            'Modules\System\Backend\Models'      => MODULE_PATH. 'system/backend/models/'
        ])->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        // TODO: Implement registerServices() method.\

        // Registering a dispatcher
        $di->set('dispatcher', $this->setDispatcher($di));
        $di->set('view', $this->setView($di));
        $di->set('url', $this->setUrl($di));
    }

    private function setDispatcher(\Phalcon\DiInterface $di)
    {
        $dispatcher = new \Phalcon\Mvc\Dispatcher();

        $eventManager = new \Phalcon\Events\Manager();

        $dispatcher->setEventsManager($eventManager);
        $dispatcher->setDefaultNamespace('Modules\System\Backend\Controllers\\');
        return $dispatcher;
    }

    private function setView(\Phalcon\DiInterface $di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');

        return $view;
    }

    private function setUrl(\Phalcon\DiInterface $di)
    {
        $url = $di->get('url');
        $url->setBaseUri($url->getBaseUri(). 'backend/');
        return $url;
    }
}