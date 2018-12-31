<?php
/**
 * Summary File Button
 *
 * Description File Button
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/31/2018
 * Time: 9:43 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Lib\Common\Arrays;

class Button
{
    private $tags = [];
    private $name;
    private $label;
    private $popup;
    private $linkTo;

    /**
     * @return mixed
     */
    public function getLinkTo()
    {
        return $this->linkTo;
    }

    /**
     * @param mixed $linkTo
     * @return Button
     */
    public function setLinkTo( $linkTo )
    {
        $this->linkTo = $linkTo;
        return $this;
    }

    /**
     * @param bool $toString
     * @return array
     */
    public function getTags($toString = false)
    {
        if($toString)
            return Arrays::arrayToStringTags($this->tags);
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Button
     */
    public function setTags( $tags )
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Button
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Button
     */
    public function setLabel( $label )
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPopup()
    {
        return $this->popup;
    }

    /**
     * @param mixed $popup
     * @return Button
     */
    public function setPopup( $popup )
    {
        $this->popup = $popup;
        return $this;
    }

    public function get($toString = false)
    {
        $row = [];
        $row = array_merge($this->tags, $row);
        if($this->popup)
            $row = array_merge($row, ['title' => $this->popup]);
        if($this->label)
            $row = array_merge($row, ['value' => $this->label]);
        if($this->linkTo)
            $row = array_merge($row, ['href' => $this->linkTo]);

        $row['id'] = $this->getName();
        $row['type'] = 'submit';
        $row['class'] = 'ilya-form-light-button ilya-form-light-button-answer';

        if($toString)
            return Arrays::arrayToStringTags($row);
        return $row;
    }
}