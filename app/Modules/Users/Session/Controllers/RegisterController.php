<?php
/**
 * Summary File RegisterController
 *
 * Description File RegisterController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/24/2018
 * Time: 11:54 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;



use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Security\Limits;
use Modules\Users\Session\Forms\RegisterForm;

class RegisterController extends Controller
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

        //$this->content->setTemplate("register");

        $this->content->form(
            Form::inst(new RegisterForm(), 'register_form')
        );

        $registerForm = $this->content->form('register_form');

        try
        {
            if($registerForm->isValid())
            {
                // Process submitted form
                $this->processSubmittedForm($registerForm);
            }
        }
        catch(\Exception $e)
        {
            dump($e->getMessage());
        }
    }

    private function processSubmittedForm($registerForm)
    {
        if(!Limits::userLimitsRemaining(Limits::ILYA_LIMIT_REGISTRATIONS))
            throw new \Exception('Too many registrations - please try again in an hour'); // register_limit

        // register and redirect
        Limits::limitsIncrement(null, Limits::ILYA_LIMIT_REGISTRATIONS);

        $user = new ModelUsers();
        $user->setUsername($this->request->getPost('username'));
        $user->setEmail($this->request->getPost('email'));
        $user->setPassword($this->request->getPost('password'));

        if(!$user->save())
        {
            foreach($user->getMessages() as $message)
            {
                $this->flash->error($message, $registerForm->prefix );
            }
        }
        else
        {
            $this->flash->success('Success register', $registerForm->prefix );

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
}