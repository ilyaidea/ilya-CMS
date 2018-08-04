<?php
/**
 * Summary File Options
 *
 * Description File Options
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/23/2018
 * Time: 12:13 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Model;

use Phalcon\Mvc\Model;

class Options extends Model
{
    public $title;
    public $content;
    public function initialize()
    {
        $this->setSource('options');
    }

    public function beforeValidationOnCreate()
    {
    }

    public static function Opt($name, $value = null)
    {
        global $ilya_options_cache;

        if (!isset($value) && isset($ilya_options_cache[$name]))
            return $ilya_options_cache[$name]; // quick shortcut to reduce calls to getOptions()

        if (isset($value))
        {
            self::setOption($name, $value);
        }

//        $options = self::getOptions([$name]);
//        return $options[$name];

        $opt = self::findFirstByTitle($name);
        if ($opt)
            return $opt->content;

        return null;
    }

    public static function setOption($name, $value, $toDB = true)
    {
        global $ilya_options_cache;

        if ($toDB && isset($value))
        {
            $opt = self::findFirstByTitle($name);
            if ($opt && isset($value))
            {
                $opt->content = $value;
                $opt->update();
            }
            else
            {
                $optObj = new Options();
                $optObj->title = $name;
                $optObj->content = $value;
                $optObj->save();
            }
        }

        $ilya_options_cache[$name] = $value;
    }

    public static function getOptions($names)
    {
        global $ilya_options_cache;

        // Pull out the options specifically requested here, and assign defaults
        $options = [];
        foreach ($names as $name)
        {
            if (!isset($ilya_options_cache[$name]))
            {
                $toDB = true;

                // ....

                self::setOption($name,self::defaultOption($name) ,$toDB);
            }

            $options[$name] = $ilya_options_cache[$name];
        }

        return $options;
    }

    public static function defaultOption($name)
    {
        $fixed_defaults = [];

        if (isset($fixed_defaults[$name]))
        {
            return $fixed_defaults[$name];
        }
    }
}