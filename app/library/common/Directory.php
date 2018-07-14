<?php
/**
 * Summary File Directory
 *
 * Description File Directory
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 10:13 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Common;

class Directory
{
    /**
     * Get sub directory of path as pattern
     *
     * Description Function getSubDirs
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $pattern
     * @return array
     * @version 1.0.0
     * @example <code>Directory::getSubDirs</code>
     */
    public static function getSubDirs($pattern)
    {
        return glob($pattern, GLOB_ONLYDIR);
    }
}