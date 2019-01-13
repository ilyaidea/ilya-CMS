<?php
namespace Ilya;

use Lib\Bootstrap\IBootstrap;
use Phalcon\Application\Exception;

include_once APP_PATH. 'Library/Bootstrap/IBootstrap.php';
class Bootstrap implements IBootstrap
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
     * Run Bootstrap Application
     */
    public function run()
    {
        $this->registerAutoLoaders();

        $services = new Services($this->config);
        $application = new \Lib\Mvc\Application($services);

        try
        {
            // Handle the request
            $response = $application->handle()->send();
//            $response->send();

//            echo $this->process_data_alan($response);
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

    public function registerAutoLoaders()
    {
        include_once APP_PATH. 'config/loader.php';
    }

    private function process_data_alan($text) //
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