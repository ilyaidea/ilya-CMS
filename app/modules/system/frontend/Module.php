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
namespace Modules\System\Frontend;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{
    public function __construct()
    {
        echo "Frontend<br>";
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
            'Modules\System\Frontend\Controllers' => MODULE_PATH. 'system/frontend/controllers/',
            'Modules\System\Frontend\Models'      => MODULE_PATH. 'system/frontend/models/'
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
        $dispatcher->setDefaultNamespace('Modules\System\Frontend\Controllers\\');
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
        $url->setBaseUri($url->getBaseUri(). 'frontend/');
        return $url;
    }
}