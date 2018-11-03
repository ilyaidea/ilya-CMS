<?php
/**
 * Summary File Buttons
 *
 * Description File Buttons
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/30/2018
 * Time: 12:16 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\TreeMenus;

use Lib\Common\Arrays;
use Phalcon\Mvc\User\Component;

class Buttons extends Component
{
    private static $storage = [];
    private static $instance;
    private static $style = 'light';
    private static $state;

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Buttons();
        }

        return self::$instance;
    }

    public function setStyle($style)
    {
        self::$style = $style;
    }

    public function addbutton($name)
    {
        self::$storage['buttons'][$name] = [];
        self::$state = $name;
        return $this;
    }

    public function setLabel($label)
    {
        if(self::$state)
        {
            self::$storage['buttons'][self::$state]['label'] = $label;
            return $this;
        }
        return null;
    }

    public function setPopup($popup)
    {
        if(self::$state)
        {
            self::$storage['buttons'][self::$state]['popup'] = $popup;
            return $this;
        }
        return null;
    }

    public function setTags($tags = [])
    {
        if(self::$state)
        {
            self::$storage['buttons'][self::$state]['tags'] = Arrays::arrayToStringTags($tags);
            return $this;
        }
        return null;
    }



    /**
     * @return array
     */
    public function getStorage()
    {
        self::$storage['style'] = self::$style;

        return self::$storage;
    }


}