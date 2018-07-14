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

class Title extends Component
{
    private static $instance;
    private static $parts = [];
    private static $separator = ' | ';

    public static function getInstance($title = null, $h1 = false)
    {
        if (!self::$instance)
        {
            self::$instance = new Title();
        }
        if ($title)
        {
            self::$instance->append($title);
            if ($h1)
            {
                self::$instance->getDI()->get('view')->setVar('title', $title);
            }
        }

        return self::$instance;
    }

    public function append($string)
    {
        if ($string)
        {
            self::$parts[] = $string;
        }
    }

    public function get()
    {
        if (!empty(self::$parts))
        {
            return implode(self::$separator, self::$parts);
        }
    }

    public function set($string)
    {
        if ($string)
        {
            self::$parts = [$string];
        }
    }
}