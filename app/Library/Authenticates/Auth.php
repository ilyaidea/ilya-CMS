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
use Ilya\Models\Users;

/**
 * Summary Class Auth
 *
 * Description Class Auth
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Lib\Authenticates
 * @version 1.0.0
 * @example Desc <code></code>
 */
class Auth extends Component
{
    /**
     * Summary Function check
     *
     * Description Function check
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param $credetials
     * @throws \Exception
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function check()
    {
        $credetials = $this->request->getPost();
        // Check if the user exist
        /** @var Users $user */
        $user = Users::findUserWithUsernameOrEmail( $credetials[ 'user_email']);
        if (!$user)
        {
            throw new \Exception('This user has not registered yet');
        }

        // Check if the password match to db
        if (!$user->checkPassword($credetials['password']))
        {
            throw new \Exception("The password you entered is incorrect");
        }

        // Check user is active
        if (!$user->isActive())
        {
            throw new \Exception('This User is not Active');
        }

        // Check if the remember me was selected
        if (isset($credetials['remember']))
        {
            $this->createRememberEnvironment($user);
        }

        // No error
        $this->session->set('auth', $user->getAuthData());
        $this->response->redirect('');
        $this->flash->success('Login Success');
    }

    public function createRememberEnvironment($user)
    {

    }

    public function remove()
    {
        $this->session->remove('auth');
    }

    public function isLoggedIn()
    {
        if ($this->session->get('auth'))
        {
            return true;
        }
        return false;
    }
}