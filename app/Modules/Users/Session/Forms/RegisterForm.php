<?php
/**
 * Summary File SignupForm
 *
 * Description File SignupForm
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 8:11 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Users\Session\Forms;

use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Forms\Element\Check;
use Lib\Forms\Element\Password;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Modules\System\PageManager\Models\Pages\ModelPages;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class RegisterForm extends Form
{
    public function init()
    {
        $this->formInfo->title->set('Sign Up Form');

        $this->addUsername();

        $this->addEmail();

        $this->addPassword();

        $this->addPasswordConfirm();

        $this->addTerms();

        $this->addSubmit();
    }

    public function addUsername()
    {
        $username = new Text('username', [
            'placeholder' => 'Choose username'
        ]);

        $username->setLabel('Username');

        if($this->isEditMode())
        {
            if($this->_entity->username !== $this->request->getPost('username'))
            {
                $username->addValidators([
                    new Uniqueness(
                        [
                            'model' => new ModelUsers(),
                            'attribute' => 'username',
                            'message' => ':field isn\'t unique'
                        ]),
                ]);
            }
        }
        else
        {
            $username->addValidators([
                new StringLength(
                    [
                        'min' => 8,
                        'messageMinimum' => ':field is too short, Minimum 8 characters'
                    ]
                ),
                new PresenceOf([
                    'message' => 'The :field is required'
                ]),
                new Uniqueness(
                    [
                        'model' => new ModelUsers(),
                        'attribute' => 'username',
                        'message' => ':field isn\'t unique'
                    ]
                )
            ]);

        }
        $this->add($username);
    }

    public function addEmail()
    {
        $email = new Text('email', [
            'placeholder' => 'Your Email Address'
        ]);

        $email->setLabel('Email');

        if($this->isEditMode())
        {
            if($this->_entity->email !== $this->request->getPost('email'))
            {
                $email->addValidators([
                    new Uniqueness(
                        [
                            'model' => new ModelUsers(),
                            'attribute' => 'email',
                            'message' => ':field isn\'t unique'
                        ]),
                ]);
            }
            $email->addValidators([ new Email(
                [
                    'message' => 'the :field is not valid'
                ]
            ),
            new PresenceOf(
                [
                    'message' => 'The :field is required'
                ]
            )
                ]);
        }
        else {
            $email->addValidators(
                [
                    new Email(
                        [
                            'message' => 'the :field is not valid'
                        ]
                    ),
                    new Uniqueness(
                        [
                            'model' => new ModelUsers(),
                            'message' => 'This :field has already been registered'
                        ]
                    ),
                    new PresenceOf(
                        [
                            'message' => 'The :field is required'
                        ]
                    )
                ]
            );
        }
        $this->add($email);
    }

    public function addPassword()
    {
        $password = new Password('password', [
            'placeholder' => 'Enter Password'
        ]);

        $password->setLabel('Password');

        $password->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The :field is required'
                    ]
                ),
                new StringLength(
                    [
                        'min' => 8,
                        'messageMinimum' => ':field is too short, Minimum 8 characters'
                    ]
                )
            ]);

        if(!$this->isEditMode()) {
            $password->addValidators(
                [
                    new Confirmation(
                        [
                            'message' => ':field doesn\'t match confirmation',
                            'with' => 'confirmPassword'
                        ])
                ]);
        }
        $this->add($password);
    }

    public function addPasswordConfirm()
    {
        $confirmPassword = new Password('confirmPassword', [
            'placeholder' => 'Confirm password'
        ]);

        $confirmPassword->setLabel('Confirm Password');

        $confirmPassword->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The :field password is required'
                    ]
                )
            ]
        );
        if(!$this->isEditMode()) {
            $this->add($confirmPassword);
        }
    }

    public function addTerms()
    {
        $terms = new Check('terms', [
            'value' => 'yes'
        ]);

        $terms->setLabel('Accept Terms');

        $terms->addValidators(
            [
                new Identical(
                    [
                        'value' => 'yes',
                        'message' => ':field and conditions must be accepted'
                    ]
                )
            ]
        );

        if(!$this->isEditMode()) {
            $this->add($terms);
        }

    }

    public function addSubmit()
    {
        $register = new Submit('save');

        $register->setLabel('Sign Up');

        $this->add($register);
    }
}