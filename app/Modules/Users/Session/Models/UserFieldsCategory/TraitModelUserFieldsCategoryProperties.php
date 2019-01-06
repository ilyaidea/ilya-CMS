<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 11:43 AM
 */

namespace Modules\Users\Session\Models\UserFieldsCategory;


trait TraitModelUserFieldsCategoryProperties
{
    public $id;
    public $title;
    public $content;
    public $lang_id;
    public $position;

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
    public function getLangId()
    {
        return $this->lang_id;
    }

    /**
     * @param mixed $lang_id
     */
    public function setLangId($lang_id)
    {
        $this->lang_id = $lang_id;
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


}