<?php
/**
 * Summary File Bootstrap
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

use Phalcon\Mvc\Application;

class Bootstrap
{
    private $config;

    /**
     * Bootstrap constructor.
     */
    public function __construct()
    {
        $this->config = include_once APP_PATH. 'config/config.php';
    }

    /**
     * Summary Function run
     *
     * Description Function run
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function run()
    {
        $this->registerAutoLoaders();

        $application = new \Phalcon\Mvc\Application(new Services($this->config));

        $this->registerModules($application);

        try
        {
            // Handle the request
            $response = $application->handle();
            $response->send();
        }
        catch (\Exception $e)
        {
            echo 'Exception: ', $e->getMessage();
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

    /**
     * Summary Function registerModules
     *
     * Description Function registerModules
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param Application $application
     * @version 1.0.0
     * @example Desc <code></code>
     */
    protected function registerModules(Application $application)
    {
        $application->registerModules(
            [
                'frontend' => [
                    'className' => 'Modules\Frontend\Module',
                    'path'      => APP_PATH. 'modules/frontend/Module.php'
                ],
                'backend' => [
                    'className' => 'Modules\Backend\Module',
                    'path'      => APP_PATH. 'modules/backend/Module.php'
                ]
            ]
        );
    }
}