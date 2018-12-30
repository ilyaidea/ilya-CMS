<?php
/**
 * Summary File TraitPropertiesPagesModel
 *
 * Description File TraitPropertiesPagesModel
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/3/2018
 * Time: 5:37 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\System\PageManager\Models\Pages;


trait TraitPropertiesPagesModel
{
    private $id;
    private $parent_id;
    private $title;
    private $language;
    private $position;
    private $created_at;
    private $modified_in;

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
    public function setId( $id ): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId( $parent_id ): void
    {
        $this->parent_id = $parent_id;
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
    public function setTitle( $title ): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage( $language ): void
    {
        $this->language = $language;
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
    public function setPosition( $position ): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt( $created_at ): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getModifiedIn()
    {
        return $this->modified_in;
    }

    /**
     * @param mixed $modified_in
     */
    public function setModifiedIn( $modified_in ): void
    {
        $this->modified_in = $modified_in;
    }
}