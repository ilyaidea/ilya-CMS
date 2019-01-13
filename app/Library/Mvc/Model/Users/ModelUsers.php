<?php
namespace Lib\Mvc\Model\Users;

use Lib\Mvc\Model;
use Phalcon\Di;

class ModelUsers extends Model
{
    use TModelUsersProperties;
    use TModelUsersRelations;
    use TModelUsersValidations;
    use TModelUsersEvents;

    public function init()
    {
        $this->setDbRef(true);
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

    public static function getUserRolesForAuth()
    {
        $session = Di::getDefault()->getShared('session')->get('auth');

        $roles = [];
        if($session)
        {
            $id = $session->id;
            $user = self::findFirst($id);

            if($user)
            {
                $roles = $user->getRoles()->toArray();
                if(!empty($roles))
                {
                    $roles = array_column($roles, 'name');
                }
            }
        }
        else
        {
            $roles[] = 'guest';
        }

        return $roles;
    }
}