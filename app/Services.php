<?php
/**
 * Summary File Services
 *
 * Description File Services
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/9/2018
 * Time: 11:30 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Ilya;

use Lib\Acl\DefaultAcl;
use Lib\Authenticates\Auth;
use Lib\Mvc\Helper;
use Lib\Mvc\View\Engine\Volt;
use Phalcon\Crypt;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files;
use Plugins\Acl;
use Plugins\NotFoundPlugin;

class Services extends \Lib\Di\FactoryDefault
{
    /**
     * Summary Function initUrl
     *
     * Description Function initUrl
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @return \Phalcon\Mvc\Url
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function initUrl()
    {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri($this->get('config')->app->baseUri);
        $url->setStaticBaseUri($this->get('config')->app->baseUri);
        $url->setBasePath($this->get('config')->app->baseUri);
        return $url;
    }

    protected function initView()
    {
        $view = new View();

        define('THEME_PATH', $this->get('config')->app->themesDir);
        $view->setMainView(THEME_PATH. 'frontend/theme');
        $view->setLayoutsDir(THEME_PATH. 'frontend/layouts/');
        $view->setLayout('main');
        $view->setPartialsDir(THEME_PATH. 'frontend/partials/');

        // Volt
        $volt = new Volt($view, $this);
        $volt->setOptions([
            'compiledPath' => BASE_PATH. 'data/cache/volt/'
        ]);
        $volt->initCompiler();


        $phtml = new View\Engine\Php($view, $this);
        $viewEngines = [
            '.volt' => $volt,
            '.phtml' => $phtml
        ];
        $view->registerEngines($viewEngines);

        return $view;
    }
    /**
     * Summary Function initDb
     *
     * Description Function initDb
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @return mixed
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function initDb()
    {

        $dbConf = $this->get('config')->database->toArray();

        $adapter = 'Phalcon\Db\Adapter\Pdo\\'. $dbConf['adapter'];
        unset($dbConf['adapter']);

        return new $adapter($dbConf);
    }

    protected function initHelper()
    {
        return new Helper();
    }

    protected function initFlash()
    {
        return new \Phalcon\Flash\Session([
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    }

    protected function initSession()
    {
        $session = new Files();
        $session->start();
        return $session;
    }

    protected function initSharedCrypt()
    {
        $crypt = new Crypt();
        $crypt->setCipher('aes-256-ctr');
        $crypt->setKey($this->get('config')->app->cryptSalt);
        return $crypt;
    }

    protected function initSecurity()
    {
        return new Security();
    }

    protected function initAuth()
    {
        return new Auth();
    }

    protected function initAcl()
    {
        return new DefaultAcl();
    }

    protected function initDispatcher()
    {
        $di = $this;
        $dispatcher = new Dispatcher();

        $eventManager = new Manager();

        $eventManager->attach('dispatch:beforeException', new NotFoundPlugin());

        $eventManager->attach('dispatch:beforeDispatchLoop', function($eventManager, $dispatcher) use ($di){
            new Acl($di->get('acl'), $dispatcher);
        });

        $dispatcher->setEventsManager($eventManager);

        return $dispatcher;
    }
}