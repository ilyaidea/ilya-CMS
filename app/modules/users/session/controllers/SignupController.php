<?php
/**
 * Summary File SignupController
 *
 * Description File SignupController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 7:22 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;

use Ilya\Models\Users;
use Lib\Mvc\Controller;
use Modules\Users\Session\Forms\SignUpForm;
use Phalcon\Mvc\View;

class SignupController extends Controller
{
    public function indexAction()
    {
        $this->setEnviroment('backend', 'session');
        $this->view->setRenderLevel(View::LEVEL_LAYOUT);
        $this->tag->setTitle('Sign up');
        $this->view->title = 'Sign up';

        $signupform = new SignUpForm();

        if ($this->request->isPost())
        {
            if ($signupform->isValid($this->request->getPost()))
            {
                $user = new Users(
                    [
                        'username' => $this->request->getPost('username'),
                        'email'    => $this->request->getPost('email'),
                        'password' => $this->security->hash($this->request->getPort('password')),
                        'active' => 'N'
                    ]
                );

                if ($user->save())
                {
                    $this->flash->success('Success save');

                    return $this->response->redirect(
                        [
                            'for'        => 'default',
                            'module'     => 'session',
                            'controller' => 'login',
                            'action'     => 'index',
                            'params'     => ''
                        ]
                    );
                }
                else
                {
                    foreach ($user->getMessages() as $message)
                    {
                        $this->flash->error($message);
                    }
                }
            }
        }

        $this->view->form = $signupform;
    }

    //There is a function to store each user's information in the database

    public function signupForm()
    {

    }
}