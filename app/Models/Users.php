<?php
/**
 * Summary File Users
 *
 * Description File Users
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:17 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Ilya\Models;

class Users extends \Phalcon\Mvc\Model
{
    public $id;
    protected $username;
    protected $email;
    protected $password;
    public $created;
    public $active = false;
    private $role;

    public function initialize()
    {
        $this->setSource('users');
    }

    public function afterSave()
    {
        $this->created = date('Y-m-d H:m:s');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $this->getDI()->get('crypt')->encryptBase64(
            $password,
            $this->getDI()->get('crypt')->getKey()
        );
    }

    public function getPassword()
    {
        return $this->getDI()->get('crypt')->decryptBase64(
            $this->password,
            $this->getDI()->get('crypt')->getKey()
        );
    }

    public function setActive($active)
    {
        if ($active)
            $this->active = true;
        else
            $this->active = false;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function isActive()
    {
        if ($this->getActive())
            return true;

        return false;
    }

    public function checkPassword($password)
    {
        if ($password == $this->getPassword())
        {
            return true;
        }
        return false;
    }

    public function getAuthData()
    {
        $authData = new \stdClass();
        $authData->id = $this->getId();
        $authData->username = $this->getUsername();
        $authData->email    = $this->getEmail();
        return $authData;
    }

    public static function findUserWithUsernameOrEmail($user_email)
    {
        return self::findFirst(
            [
                "(username = :user_email: OR email = :user_email:) AND active = :active:",
                'bind' => [
                    'user_email' => $user_email,
                    'active'     => true
                ]
            ]
        );
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole( $role )
    {
        $this->role = $role;
    }


}