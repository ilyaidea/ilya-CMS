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

class Strings
{
    public static function IsStartBy( $string, $by, $caseSensitive = false, $maxLenghtString = null )
    {
        if(!$caseSensitive)
        {
            $string = strtolower($string);
            $by = strtolower($by);
        }

        if ( !is_null($maxLenghtString) && (strlen($string) > $maxLenghtString) && (strpos($string, $by) === 0))
            return true;
        elseif (is_null($maxLenghtString) && strpos($string, $by) === 0)
            return true;

        return false;
    }

    public static function IsEndBy( $string, $by, $caseSensitive = false)
    {
        $length = strlen($by);

        if(!$caseSensitive)
        {
            $string = strtolower($string);
            $by = strtolower($by);
        }

        if ($length == 0) {
            return true;
        }

        return (substr($string, -$length) === $by);
    }

    /**
     * Return true if at least one of the values in array $matches is a substring of $string. Otherwise, return false.
     *
     * @param string $string
     * @param array $matches
     * @return bool
     */
    public static function stringMatchesOne($string, $matches)
    {
        if(strlen($string))
        {
            foreach($matches as $match)
            {
                if(strpos($string, $match) !== false)
                    return true;
            }
        }

        return false;
    }
}