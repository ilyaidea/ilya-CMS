<?php
/**
 * Summary File Bootstrap
 *
 * We introduce the namespace in classes so that if we had another class with the same name
 ,we would recognize another class in another class
 *
 * Description File Bootstrap
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/9/2018
 * Time: 10:50 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Ilya;

use Phalcon\Application\Exception;

class Bootstrap
{
    private $config;

    /**
     * Bootstrap constructor.
     *
     * construct: Config path to be specified. And the config will be voiced
     */
    public function __construct()
    {
        $this->config = include_once APP_PATH. 'config/env/'.APP_ENV.'.php';
    }

    /**
     * Summary Function run
     *
     * Description Function run
     *
     * When bootstrap runs, it becomes config
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function run()
    {
        $this->registerAutoLoaders();

        $application = new \Lib\Mvc\Application(new Services($this->config));

        try
        {
            // Handle the request
            $response = $application->handle();
            $response->send();
        }
        catch (Exception $e)
        {
            if(preg_match('/^Module \'(.*?)\' isn\'t registered in the application container$/', $e->getMessage(), $match)) {
                // You can get the attempted module name from the router:
                echo 'Exception: ', $e->getMessage();
                echo '<pre>', var_dump($application->router->getModuleName()), '</pre>';
                // Or the regexp match
                echo '<pre>', var_dump($match[1]), '</pre>';
                // Then handle it as you wish...
//                echo $application->handle('/')->getContent();
            }
        }
    }

    /**
     * Summary Function registerAutoLoaders
     *
     * Description Function registerAutoLoaders
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function registerAutoLoaders()
    {
        include_once APP_PATH. 'config/loader.php';
    }
}