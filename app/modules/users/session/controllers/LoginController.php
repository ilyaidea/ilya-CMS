<?php
/**
 * Summary File LoginController
 *
 * Description File LoginController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/24/2018
 * Time: 8:21 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use Ilya\Models\Users;
use Lib\Mvc\Controller;
use Modules\Users\Session\Forms\LoginForm;
use Phalcon\Mvc\View;

class LoginController extends Controller
{
    public function indexAction()
    {
        $this->setEnviroment('backend', 'session');
        $this->view->setRenderLevel(View::LEVEL_LAYOUT);
        $this->tag->setTitle('Log in');
        $this->view->title = 'Log in';

        $loginForm = new LoginForm();

        try
        {
            if ($this->request->isPost() && $loginForm->isValid($this->request->getPost()))
            {
                $this->checkAuthenticate();
            }
        }
        catch (\Exception $exception)
        {
            $this->exceptionPrint($exception);
        }

        $this->view->form = $loginForm;
    }

    private function checkAuthenticate()
    {
        $user = Users::findFirst(
            [
                "(email = :user_email: OR username = :user_email:) AND active = 'Y'",
                'bind' => [
                    'user_email' => $this->request->getPost('user_email'),
                ]
            ]
        );

        if (!$user)
        {
            throw new \Exception("This user has not registered yet");
        }

        if (!$this->isEqualVars($user->password, $this->request->getPost('password')))
        {
            throw new \Exception("The password you entered is incorrect");
        }

        $this->flash->success('Login Success');
    }

    private function exceptionPrint(\Exception $exception)
    {
        if (is_array($exception->getMessage()))
        {
            foreach ($exception as $e)
            {
                $this->flash->error($e);
            }
        }
        else
        {
            $this->flash->error($exception->getMessage());
        }
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