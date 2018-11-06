<?php
/**
 * Summary File Title
 *
 * Description File Title
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/5/2018
 * Time: 9:34 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Lib\Common\Arrays;

class Title
{
    /** @var string $title */
    private $title;
    /** @var array $tags */
    private $tags = [];

    public function __construct()
    {
    }

    public function set($title)
    {
        $this->title = $title;
    }

    public function get()
    {
        return $this->title;
    }

    /**
     * @param bool $toAttr
     * @return string|array
     */
    public function getTags($toAttr = false)
    {
        if($toAttr === true)
            return Arrays::arrayToStringTags($this->tags);

        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function addTags( array $tags ): void
    {
        if(is_array($tags))
            $this->tags = array_merge($this->tags, $tags);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function appendTag($key, $value): void
    {
        if($key && $value)
        {
            $this->tags[$key] = $value;
        }
    }
}