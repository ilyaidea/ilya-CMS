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

use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * Summary Class Title
 *
 * Description Class Title
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Lib\Mvc\Helper
 * @version 1.0.0
 * @example Desc <code></code>
 * @property Helper $helper
 */
class HtmlTags extends Component
{
    private static $instance;
    private static $parts = [];
    private static $separator = ' | ';

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new HtmlTags();
        }

        $langVal = self::$instance->helper->locale()->getLanguage();
        self::$instance->add('lang', $langVal);

        return self::$instance;
    }

    public function add($name, $val)
    {
        if ($name && $val)
        {
            self::$parts[$name] = $val;
        }
    }

    public function get()
    {
        $tags = '';
        if (!empty(self::$parts))
        {
            $count = count(self::$parts);
            $i = 1;
            foreach(self::$parts as $name => $val)
            {
                $tags .= ' '. $name. '="'.$val.'"';
//                if($i != $count)
//                    $tags .= ' ';
                $i++;
            }
        }
        return $tags;
    }

}