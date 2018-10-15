<?php
/**
 * Summary File Strings
 *
 * Description File Strings
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/13/2018
 * Time: 9:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Common;

class Arrays
{
    public static function arrayToStringTags( $array )
    {
        $tags = '';

        if(!(is_array($array) && !empty($array)))
        {
            return $tags;
        }

        foreach($array as $key => $value)
        {
            $tags .= $key. '="'. $value. '" ';
        }

        return $tags;
    }
}