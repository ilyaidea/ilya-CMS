<?php
/**
 * Summary File Title
 *
 * Description File Title
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/14/2018
 * Time: 8:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Helper;

use Phalcon\Mvc\User\Component;

class Locale extends Component
{
    private static $instance;
    private static $language = 'en';
    private static $direction = 'ltr';

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Locale();
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return self::$language;
    }

    /**
     * @param string $language
     */
    public function setLanguage( $language )
    {
        self::$language = $language;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return self::$direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection( $direction )
    {
        self::$direction = $direction;
    }
}