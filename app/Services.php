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

use Phalcon\Mvc\Router;

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
        return $url;
    }

    /**
     * this method creates a connection by instantiating the adapter class.
     *
     * adapter => requires an array with the connection parameters
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @return mixed
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function initDb()
    {
        $adapter = '\Phalcon\Db\Adapter\Pdo\\'. $this->get('config')->database->adapter;

        $db = new $adapter([
            'host'     => $this->get('config')->database->host,
            'username' => $this->get('config')->database->username,
            'password' => $this->get('config')->database->password,
            'dbname'   => $this->get('config')->database->dbname
        ]);

        return $db;
    }

    /**
     * This method defines routes whose paths include modules by parsing url to determine this information.
     *
     * Add method =>using pattern you want to match and a set of paths to define a route.
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function initRouter()
    {
        $router = new Router();

        $router->setDefaultModule('frontend');
        $router->add('/:module/:controller/:action/:params', [
            'module' => 1,
            'controller' => 2,
            'action' => 3,
            'params' => 4
        ])->setName('default_route');

        return $router;
    }
}