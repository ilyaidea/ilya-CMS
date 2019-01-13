<?php
namespace Lib\Mvc\Model\UsersRolesMap;

trait TModelUsersRolesMapProperties
{
    private $id;
    private $user_id;
    private $role_id;

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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId( $user_id )
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId( $role_id )
    {
        $this->role_id = $role_id;
    }
}