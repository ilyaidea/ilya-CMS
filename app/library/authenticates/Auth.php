<?php
/**
 * Summary File Auth
 *
 * Description File Auth
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/30/2018
 * Time: 6:30 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Authenticates;

use Phalcon\Mvc\User\Component;

class Auth extends Component
{
    public function check($credetials)
    {
        // Check if the user exist
        $user = \Ilya\Models\Users::findUserWithUsernameOrEmail($credetials['user_email']);
        if (!$user)
        {
            throw new \Exception('This user has not registered yet');
        }

        if (!$this->isEqualVars($user->password, $credetials['password']))
        {
            throw new \Exception("The password you entered is incorrect");
        }

        $this->flash->success('Login Success');
    }

    private function isEqualVars($var1, $var2)
    {
        if ($var1 == $var2)
        {
            return true;
        }
        return false;
    }
}