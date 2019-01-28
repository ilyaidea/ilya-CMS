<?php
namespace Lib\Mvc\Model\Roles;


trait TModelRolesProperties
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     *  Fields
     */

    private $id;
    private $parent_id;
    private $name;
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId( $parent_id )
    {
        $this->parent_id = $parent_id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription( $description )
    {
        $this->description = $description;
    }
}