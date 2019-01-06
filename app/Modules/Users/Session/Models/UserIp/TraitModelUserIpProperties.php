<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 12:05 PM
 */

namespace Modules\Users\Session\Models\UserIp;


trait TraitModelUserIpProperties
{
    public $id;
    public $counter;
    public $create_ip;

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
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param mixed $counter
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;
    }

    /**
     * @return mixed
     */
    public function getCreateIp()
    {
        return $this->create_ip;
    }

    /**
     * @param mixed $create_ip
     */
    public function setCreateIp($create_ip)
    {
        $this->create_ip = $create_ip;
    }

}