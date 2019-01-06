<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 12:02 PM
 */

namespace Modules\Users\Session\Models\UserFieldsMap;


trait TraitModelUserFieldsMapProperties
{
    public $id;
    public $user_fields_id;
    public $user_id;
    public $content;

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
    public function getUserFieldsId()
    {
        return $this->user_fields_id;
    }

    /**
     * @param mixed $user_fields_id
     */
    public function setUserFieldsId($user_fields_id)
    {
        $this->user_fields_id = $user_fields_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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



}