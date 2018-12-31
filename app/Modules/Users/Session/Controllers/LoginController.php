<?php
/**
 * Summary File LoginController
 *
 * Description File LoginController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/23/2018
 * Time: 8:27 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Security\Limits;
use Modules\Users\Session\Forms\LoginForm;
use Phalcon\Mvc\Dispatcher;

class LoginController extends Controller
{
    private $redirectTo;

    public function init()
    {
        $this->redirectTo = $this->request->get('to');

        if($this->auth->isLoggedIn())
        {
            if($this->redirectTo)
                $this->response->redirect($this->redirectTo);
            else
                $this->response->redirect('');

            $this->response->send();
        }
    }

    public function indexAction()
    {
        // Get information about possible additional fields

        // Check we haven't suspended registration, and this IP isn't blocked

        //
        $this->content->theme->noLeftMasterPage();

        $this->content->form(
            Form::inst(new LoginForm(), 'login_form')
        );

        $loginForm = $this->content->form('login_form');

        $loginForm->buttons()
            ->add('edit')
            ->setLabel('Edit')
            ->setPopup('Edit this')
            ->setLinkTo($this->url->get('register'))
            ->setTags([
                'name' => 'q_doedit'
            ]);

        try
        {
            if($loginForm->isValid())
            {
                // Process submitted form
                $this->processSubmittedForm($loginForm);
            }
        }
        catch(\Exception $e)
        {
            dump($e->getMessage());
        }
    }

    private function processSubmittedForm($loginForm)
    {
        if(!Limits::userLimitsRemaining(Limits::ILYA_LIMIT_REGISTRATIONS))
            throw new \Exception('Too many registrations - please try again in an hour'); // register_limit

        // register and redirect
        Limits::limitsIncrement(null, Limits::ILYA_LIMIT_REGISTRATIONS);

        /** @var ModelUsers $user */
        $user = ModelUsers::findUserWithUsernameOrEmail(
            $this->request->getPost('user_email')
        );
        if (!$user)
        {
            throw new \Exception('This user has not registered yet');
        }

        // Check if the password match to db
        if (!$user->checkPassword($this->request->getPost('password')))
        {
            throw new \Exception("The password you entered is incorrect");
        }

        // No error
        $this->session->set('auth', $user->getAuthData());

        $this->flash->success('Success Login', $loginForm->prefix );

        if($this->request->get('to'))
        {
            $this->response->redirect(
                $this->request->get('to')
            );
        }
        else
        {
            $this->response->redirect('');
        }
        $this->response->send();

    }
}