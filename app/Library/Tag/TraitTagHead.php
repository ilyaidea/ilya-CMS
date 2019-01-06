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

trait TraitTagHead
{
    protected static $_charset = 'utf-8';
    protected static $_meta_description = null;
    protected static $_meta_keywords = [];
    protected static $_meta_keywords_separator = ',';
    protected static $_head_lines = [];

    /**
     * Set meta Charset
     *
     * @param string $charset
     */
    public static function setMetaCharset( $charset)
    {
        if(strlen($charset))
            self::$_charset = $charset;
    }

    /**
     * Get meta Charset
     *
     * @return string
     */
    public static function getMetaCharset()
    {
        return self::$_charset;
    }

    /**
     * Set meta description
     *
     * @param string $content
     */
    public static function setMetaDescription( $content)
    {
        self::$_meta_description = $content;
    }

    /**
     * Get meta description
     *
     * @return null|string
     */
    public static function getMetaDescription()
    {
        return self::$_meta_description;
    }

    public static function setMetaKeywords(array $keywords)
    {
        self::$_meta_keywords = $keywords;
    }

    public static function setMetaKeywordsSeparator($separator = ',')
    {
        self::$_meta_keywords_separator = $separator;
    }

    /**
     * Append one keyword to keywords
     *
     * @param string $keyword
     */
    public static function appendMetaKeyword($keyword)
    {
        self::$_meta_keywords[] = $keyword;
    }

    /**
     * Append multi keyword as array to keywords
     *
     * @param array $keywords
     */
    public static function appendMetaKeywords($keywords)
    {
        if(is_array($keywords))
            self::$_meta_keywords = array_merge(self::$_meta_keywords, $keywords);
    }

    /**
     * Get keywords
     *
     * @param bool $toString
     * @return array|string
     */
    public static function getMetaKeywords( $toString = false)
    {
        if($toString === true)
        {
            return implode(', ', self::$_meta_keywords);
        }

        return self::$_meta_keywords;
    }

    /**
     * Set Head lines
     *
     * @param string|array $lines
     */
    public static function setHeadLines( $lines)
    {
        if(is_string($lines))
            self::$_head_lines = [$lines];

        if(is_array($lines))
            self::$_head_lines = $lines;
    }

    /**
     * Append one line to Lines
     *
     * @param string $line
     */
    public static function appendHeadLine( $line)
    {
        if(is_string($line))
            self::$_head_lines[] = $line;
    }

    /**
     * Set multi line to lines
     *
     * @param array $lines
     */
    public static function appendHeadLines( $lines)
    {
        if(is_array($lines))
        {
            self::$_head_lines = array_merge(self::$_head_lines, $lines);
        }
    }

    public static function getHeadLines()
    {
        return self::$_head_lines;
    }

}