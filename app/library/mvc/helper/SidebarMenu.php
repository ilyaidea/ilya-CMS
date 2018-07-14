<?php
/**
 * Summary File SidebarMenu
 *
 * Description File SidebarMenu
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/23/2018
 * Time: 6:13 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper;

use Phalcon\Mvc\User\Component;

class SidebarMenu extends Component
{
    private static $instance;
    private static $menu = [];

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new SidebarMenu();
        }

        return self::$instance;
    }

    public function get()
    {
        if (!empty(self::$menu))
        {
            return self::$menu;
        }
    }

    public function set($menu)
    {
        if (is_array($menu))
        {
            self::$menu = $menu;
        }
    }

}