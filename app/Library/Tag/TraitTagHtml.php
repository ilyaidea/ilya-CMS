<?php
/**
 * Summary File TraitTagHtml
 *
 * Description File TraitTagHtml
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/3/2019
 * Time: 1:54 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Tag;


use Lib\Common\Arrays;

trait TraitTagHtml
{
    /**
     * HTML document html tags
     */
    protected static $_html_tags = [];

    /**
     * Set document tags for html
     *
     * @param array $tags
     */
    public static function setHtmlTags($tags)
    {
        if(is_array($tags))
        {
            self::$_html_tags = $tags;
        }
    }

    /**
     * Append to html tags
     *
     * @param string $tag
     * @param mixed $value
     */
    public static function appendHtmlTag( $tag, $value)
    {
        self::$_html_tags[$tag] = $value;
    }

    /**
     * Get html tags
     *
     * @param bool $toString
     * @return array|null|string
     */
    public static function getHtmlTags( $toString = false)
    {
        if($toString === true)
            return Arrays::arrayToStringTags(self::$_html_tags);

        return self::$_html_tags;
    }
}