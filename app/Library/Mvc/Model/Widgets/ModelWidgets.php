<?php
/**
 * Summary File ModelWidgets
 *
 * Description File ModelWidgets
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/6/2019
 * Time: 9:02 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Widgets;


use Lib\Mvc\Model;

class ModelWidgets extends Model
{
    private $id;
    private $place;
    private $position;
    private $tags;
    private $namespace;

    public function init()
    {
        $this->setSource('ilya_widgets');
        $this->setDbRef(true);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace( $place )
    {
        $this->place = $place;
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
    public function setPosition( $position )
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags( $tags )
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace( $namespace )
    {
        $this->namespace = $namespace;
    }
}