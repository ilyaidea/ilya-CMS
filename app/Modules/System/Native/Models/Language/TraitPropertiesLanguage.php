<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 12/30/2018
 * Time: 10:26 AM
 */

namespace Modules\System\Native\Models\Language;

trait TraitPropertiesLanguage
{
    private $id;
    private $iso;
    private $title;
    private $position;
    private $is_primary;
    private $direction;

    public function getId()
    {
        return $this->id;
    }

    public function setId( $id )
    {
        $this->id = $id;
    }

    public function getIso()
    {
        return $this->iso;
    }

    public function setIso( $iso )
    {
        $this->iso = $iso;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title )
    {
        $this->title = $title;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition( $position )
    {
        $this->position = $position;
    }

    public function getIsPrimary()
    {
        return $this->is_primary;
    }

    public function setIsPrimary( $is_primary )
    {
        $this->is_primary = $is_primary;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setDirection( $direction )
    {
        $this->direction = $direction;
    }

}