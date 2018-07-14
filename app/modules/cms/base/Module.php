<?php
/**
 * Summary File Module
 *
 * Description File Module
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/13/2018
 * Time: 12:33 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Cms\Base;

use Phalcon\DiInterface;
use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{
    public function __construct()
    {
        echo "Base<br>";
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $di->setShared('configModule', include_once 'config.php');

        $loader = new Loader();

        $loader->registerNamespaces([
            $di->get('configModule')->namespace. '\Controllers' => $di->get('configModule')->path. '/controllers/',
            $di->get('configModule')->namespace. '\Models'      => $di->get('configModule')->path. '/models/',
            $di->get('configModule')->namespace. '\Lib'      => $di->get('configModule')->path. '/library/'
        ])->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', $this->setDispatcher($di));

        $di->set('view', $this->setView($di));

        $di->set('url', $this->setUrl($di));
    }

    /**
     * Summary Function setDispatcher
     *
     * Description Function setDispatcher
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $di
     * @return Dispatcher
     * @version 1.0.0
     * @example Desc <code></code>
     */
    private function setDispatcher($di)
    {
        $dispatcher = new Dispatcher();

        $eventManager = new Manager();

        $dispatcher->setEventsManager($eventManager);
        $dispatcher->setDefaultNamespace($di->get('configModule')->namespace. '\Controllers\\');
        return $dispatcher;
    }

    /**
     * Summary Function setView
     *
     * Description Function setView
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $di
     * @return View
     * @version 1.0.0
     * @example Desc <code></code>
     */
    private function setView($di)
    {
        $view = $di->get('view');
        $view->setViewsDir(__DIR__ . '/views/');

        return $view;
    }
    /**
     * Summary Function setView
     *
     * Description Function setView
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $di
     * @return View
     * @version 1.0.0
     * @example Desc <code></code>
     */
    private function setUrl($di)
    {
        $url = $di->get('url');
        $url->setBaseUri($url->getBaseUri(). 'base/');
        return $url;
    }
}