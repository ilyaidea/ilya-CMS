<?php
/**
 * Summary File Tag
 *
 * Description File Tag
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/1/2018
 * Time: 8:20 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib;


class Tag extends \Phalcon\Tag
{
    public static function staticField( $parameters )
    {
        return "<div>Static field</div>";
    }
}