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

use Lib\Mvc\Helper;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;

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
        $url->setBasePath('/cms/');
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
        $volt = new View\Engine\Volt($view, $this);
        $volt->setOptions([
            'compiledPath' => BASE_PATH. 'data/cache/volt/'
        ]);

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
    protected function initSharedDb()
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
}