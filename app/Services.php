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
use Lib\Contents\ContentBuilder;
use Lib\Debug;
use Lib\Filter;
use Lib\Flash\Session;
use Lib\Http\Response;
use Lib\Mvc\Helper;
use Lib\Mvc\View;
use Lib\Mvc\View\Engine\Volt;
use Lib\Plugins\Localization;
use Lib\Assets\Minify\CSS;
use Lib\Assets\Minify\JS;
use Lib\Tag;
use Phalcon\Cache\Backend\File;
use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Cache\Backend\Memcache;
use Phalcon\Cache\Frontend\Data;
use Phalcon\Crypt;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Registry;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files;
use Plugins\Acl;
use Plugins\DbManagerPlugin;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class Services extends \Lib\Di\FactoryDefault
{
    protected function initSharedRegistry()
    {
        return new Registry();
    }

    protected function initSharedManager()
    {
        return new Manager();
    }

    protected function initUrl()
    {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri($this->getShared('config')->app->baseUri);
        $url->setStaticBaseUri($this->getShared('config')->app->baseUri);
        $url->setBasePath($this->getShared('config')->app->baseUri);
        return $url;
    }

    protected function initSharedContent()
    {
        return ContentBuilder::instantiate();
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

        /** @var Manager $eventManager */
        $eventManager = $this->getShared('manager');
        $eventManager->attach('view:beforeRender', function() {
            /** @var ContentBuilder $content */
            $content = $this->getShared('content');
            $content->process();
        });
        $view->setEventsManager($eventManager);

        return $view;
    }

    protected function initSharedResponse()
    {
        return new Response();
    }

    protected function initSharedDb()
    {
        $dbConf = $this->getShared('config')->database->toArray();

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
        return new Session();
    }

    protected function initSharedSession()
    {
        $session = new Files();
        $session->start();
        return $session;
    }

    protected function initSharedCrypt()
    {
        $crypt = new Crypt();
        $crypt->setCipher('aes-256-ctr');
        $crypt->setKey($this->getShared('config')->app->cryptSalt);
        return $crypt;
    }

    protected function initSharedAssets()
    {
        $assets = new \Lib\Assets\Manager();
        return $assets;
    }

    protected function initSharedCssmin()
    {
        $cssMin = new CSS();
        return $cssMin;
    }

    protected function initSharedJsmin()
    {
        $jsMin = new JS();
        return $jsMin;
    }

    protected function initUploader()
    {
        $uploader = new Uploader();

        $uploader->setRules([
            'directory' => BASE_PATH.'data/files/',
            'minsize' => 1000,
            'maxsize' => 10000000, // 10 MB
            'mimes'   => [
                'image/jpeg',
                'image/png'
            ],
            'extensions' => [
                'jpeg',
                'jpg',
                'png'
            ],
            'sanitize' => true,
            'hash' => 'md5'
        ]);
        return $uploader;
    }

    protected function initSecurity()
    {
        return new Security();
    }

    protected function initSharedFilter()
    {
        return new Filter();
    }

    protected function initSharedModelsCache()
    {
        $config = $this->getShared('config');
        $frontendCache = new Data([
            'lifetime' => 60,
            'prefix'   => HOST_HASH
        ]);

        $cache = null;

        switch($config->cache)
        {
            case "file":
                $cache = new File($frontendCache, [
                    'cacheDir' => BASE_PATH. 'data/cache/backend/'
                ]);
                break;
            case "memcache":
                $cache = new Memcache(
                    $frontendCache,
                    [
                        'host' => $config->memcache->host,
                        'port' => $config->memcache->port,
                    ]
                );
                break;
            case "memcached":
                $cache = new Libmemcached(
                    $frontendCache,
                    [
                        'host' => $config->memcache->host,
                        'port' => $config->memcache->port,
                    ]
                );
                break;
        }

        return $cache;
    }

    protected function initAuth()
    {
        return new Auth();
    }

    protected function initSharedAcl()
    {
        return new DefaultAcl();
    }

    protected function initSharedTag()
    {
        return new Tag();
    }

    protected function initSharedForms()
    {
        return new \Lib\Forms\Manager();
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
            new Acl($di->getShared('acl'), $dispatcher, $di->getShared('view'));
        });

        $dispatcher->setEventsManager($eventManager);

        return $dispatcher;
    }

    protected function initSharedTransactions()
    {
        return new TransactionManager();
    }

    protected function initDebug()
    {
        return new Debug();
    }

    /**
     * Run in end application
     */
    protected function afterInitDebug()
    {
        /** @var Debug $debug */
        $debug = $this[ 'debug'];
        $debug->listen();
    }
}