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

namespace Lib\Mvc\Model\Users;

use Lib\Mvc\Model;

class ModelUsers extends Model
{
    use TModelUsersProperties;
    use TModelUsersRelations;
    use TModelUsersValidations;
    use TModelUsersEvents;

    public function init()
    {
        $this->setSource('ilya_users');
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

    public function checkPassword($password)
    {
        if ($password === $this->getPassword())
            return true;

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
                "(username = :user_email: OR email = :user_email:)",
                'bind' => [
                    'user_email' => $user_email
                ]
            ]
        );
    }
}