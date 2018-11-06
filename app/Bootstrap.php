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
            $response = $application->handle()->getContent();
//            $response->send();

//            echo $response;
            echo $this->process_data_alan($response);
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

    function process_data_alan($text) //
    {
        $re = '%# Collapse ws everywhere but in blacklisted elements.
        (?>             # Match all whitespans other than single space.
          [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
        | \s{2,}        # or two or more consecutive-any-whitespace.
        ) # Note: The remaining regex consumes no text at all...
        (?=             # Ensure we are not in a blacklist tag.
          (?:           # Begin (unnecessary) group.
            (?:         # Zero or more of...
              [^<]++    # Either one or more non-"<"
            | <         # or a < starting a non-blacklist tag.
              (?!/?(?:textarea|pre)\b)
            )*+         # (This could be "unroll-the-loop"ified.)
          )             # End (unnecessary) group.
          (?:           # Begin alternation group.
            <           # Either a blacklist start tag.
            (?>textarea|pre)\b
          | \z          # or end of file.
          )             # End alternation group.
        )  # If we made it here, we are not in a blacklist tag.
        %ix';
        $text = preg_replace($re, " ", $text);
        return $text;
    }
}