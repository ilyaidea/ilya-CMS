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
    public $username;
    public $email;
    protected $password;
    public $created;
    public $active;

    public function initialize()
    {
        $this->setSource('users');
    }

    public function afterSave()
    {
        $this->created = date('Y-m-d H:m:s');
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

    public static function findUserWithUsernameOrEmail($user_email)
    {
        return self::findFirst(
            [
                "(username = :user_email: OR email = :user_email:) AND active = 'Y'",
                'bind' => [
                    'user_email' => $user_email
                ]
            ]
        );
    }
}