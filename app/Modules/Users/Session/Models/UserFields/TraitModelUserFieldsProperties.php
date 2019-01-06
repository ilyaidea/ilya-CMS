<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 11:28 AM
 */

namespace Modules\Users\Session\Models\UserFields;


trait TraitModelUserFieldsProperties
{
    public $id;
    public $user_fields_category_id;
    public $title;
    public $content;
    public $position;
    public $flags;
    public $permit;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserFieldsCategoryId()
    {
        return $this->user_fields_category_id;
    }

    /**
     * @param mixed $user_fields_category_id
     */
    public function setUserFieldsCategoryId($user_fields_category_id)
    {
        $this->user_fields_category_id = $user_fields_category_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param mixed $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return mixed
     */
    public function getPermit()
    {
        return $this->permit;
    }

    /**
     * @param mixed $permit
     */
    public function setPermit($permit)
    {
        $this->permit = $permit;
    }



}