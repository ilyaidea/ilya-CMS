<?php
/**
 * Summary File LoginForm
 *
 * Description File LoginForm
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/28/2018
 * Time: 8:45 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Forms;


use Lib\Forms\Form;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $this->setTitleForm('Login Form', [
            'id' => 'login-form'
        ]);

        $this->setAction('#login-form');

        $this->setUserOption('name', 'ali');
        $this->addEmailOrUsername();
        $this->addPassword();
        $this->addRememberMe();
        $this->addSubmit();
    }

    private function addEmailOrUsername()
    {
        $emailOrUsername = new Text('user_email', [
            'placeholder' => 'Enter Email Or Username'
        ]);

        $emailOrUsername->setLabel('Email Or Username');

        $emailOrUsername->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'This field is required'
                    ]
                )
            ]
        );
        $this->add($emailOrUsername);
    }

    private function addPassword()
    {
        $password = new Password('password', [
            'placeholder' => 'Enter Password'
        ]);

        $password->setLabel('Password');

        $password->addValidator(
            new PresenceOf(
                [
                    'message' => 'The :field is required'
                ]
            )
        );
        $password->clear();
        $this->add($password);
    }

    private function addRememberMe()
    {
        $remember = new Check('remember', [
            'value' => true
        ]);

        $remember->setLabel('Remember Me');

        $this->add($remember);
    }

    private function addSubmit()
    {
        $submit = new Submit('save');

        $submit->setLabel('Login');

        $this->add($submit);
    }

}