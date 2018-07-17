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
    /**
     * Summary Function isMethodNameStart
     *
     * Description Function isMethodNameStart
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $name
     * @param $maxLenght
     * @param $needle
     * @return bool
     * @version 1.0.0
     */
    public static function IsStartBy( $string, $by, $maxLenghtString = null )
    {
        if ( !is_null($maxLenghtString) && (strlen($string) > $maxLenghtString) && (strpos($string, $by) === 0))
            return true;
        elseif (is_null($maxLenghtString) && strpos($string, $by) === 0)
            return true;

        return false;
    }
}