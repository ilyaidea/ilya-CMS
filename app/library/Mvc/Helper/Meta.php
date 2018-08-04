<?php
/**
 * Summary File Meta
 *
 * Description File Meta
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/17/2018
 * Time: 6:35 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper;

use Phalcon\Escaper;
use Phalcon\Mvc\User\Component;

class Meta extends Component
{
    private static $instance;
    private static $storage = [];

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Meta();
        }
        return self::$instance;
    }

    public function set($name, $content)
    {
        self::$storage[$name] = $content;
    }

    public function get($name)
    {
        if (array_key_exists($name, self::$storage))
        {
            $content = self::$storage[$name];
            $escaper = new Escaper();
            return "<meta name='{$name}' content='{$escaper->escapeHtml($content)}'>\n";
        }
    }

}