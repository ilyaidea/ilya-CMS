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
use Lib\Mvc\View;
use Lib\Mvc\View\Engine\Volt;
use Lib\Plugins\Localization;
use Phalcon\Crypt;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files;
use Plugins\Acl;
use Plugins\DbManagerPlugin;

class Services extends \Lib\Di\FactoryDefault
{
    protected function initSharedManager()
    {
        return new Manager();
    }

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

    protected function initSharedView()
    {
        $view = new View();

        define('THEME_PATH', $this->getShared('config')->app->themesDir);
        $view->setMainView(THEME_PATH. 'base/theme');
        $view->setLayoutsDir(THEME_PATH. 'base/layouts/');
        $view->setLayout('main');
        $view->setPartialsDir(THEME_PATH. 'base/partials/');


        // Volt
        $volt = new Volt($view, $this);
        $volt->setOptions([
            'compiledPath' => BASE_PATH. 'data/cache/volt/'
        ]);
        $volt->initCompiler();


        $phtml = new Php($view, $this);
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
    protected function initSharedDb()
    {
        $dbConf = $this->get('config')->database->toArray();

        $adapter = 'Phalcon\Db\Adapter\Pdo\\'. $dbConf['adapter'];
        unset($dbConf['adapter']);

        /** @var Mysql $connection */
        $connection = new $adapter($dbConf);

        /** @var Manager $eventManager */
        $eventManager = $this->getShared('manager');

        $connection->setEventsManager($eventManager);
        return $connection;
    }

    protected function initSharedHelper()
    {
        return new Helper();
    }

    protected function initFlash()
    {
        return new \Phalcon\Flash\Session([
            'error' => 'ilya-error',
            'success' => 'ilya-success',
            'notice' => 'ilya-notice',
            'warning' => 'ilya-warning'
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

    protected function initSharedAcl()
    {
        return new DefaultAcl();
    }

    protected function initSharedDispatcher()
    {
        $di = $this;
        $dispatcher = new Dispatcher();

        $eventManager = $this->getShared('manager');

//        $eventManager->attach('dispatch:beforeException', new NotFoundPlugin());

        $eventManager->attach('dispatch:beforeDispatchLoop', function($eventManager, Dispatcher $dispatcher) use ($di){
            new DbManagerPlugin();
            new Localization($dispatcher);
//            new Acl($di->getShared('acl'), $dispatcher, $di->getShared('view'));
        });

        $dispatcher->setEventsManager($eventManager);

        return $dispatcher;
    }
}