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

use Ilya\Models\Users;
use Lib\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * Summary Class SignUpForm
 *
 * Description Class SignUpForm
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Modules\Users\Session\Forms
 * @version 1.0.0
 * @example Desc <code></code>
 */
class SignUpForm extends Form
{
    /**
     * Summary Function initialize
     *
     * Description Function initialize
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param null $entity
     * @param null $options
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function initialize($entity = null, $options = null)
    {
        $this->setTitleForm('Sign Up Form', [
            'id' => 'sign-up-form'
        ]);

        $this->setAction('#sign-up-form');

        $this->addusername();

        $this->addEmail();

        $this->addpassword();

        $this->addpasswordconfirm();

        $this->addterms();

        $this->addCSRF();

        $this->addsubmit();
    }

    public function addusername()
    {
        $username = new \Phalcon\Forms\Element\Text('username', [
            'placeholder' => 'Choose username'
        ]);

        $username->setLabel('Username');

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
                    'model' => new Users(),
                    'attribute' => 'username',
                    'message' => ':field isn\'t unique'
                ]
            )
        ]);
        $this->add($username);
    }

    public function addEmail()
    {
        $email = new \Phalcon\Forms\Element\Text('email', [
            'placeholder' => 'Your Email Address'
        ]);

        $email->setLabel('Email');

        $email->addValidators(
            [
                new Email(
                    [
                        'message' => 'the :field is not valid'
                    ]
                ),
                new Uniqueness(
                    [
                        'model' => new Users(),
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
        $this->add($email);
    }

    public function addpassword()
    {
        $password = new \Phalcon\Forms\Element\Password('password', [
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
                ),
                new Confirmation(
                    [
                        'message' => ':field doesn\'t match confirmation',
                        'with' => 'confirmPassword'
                    ]
                )
            ]
        );
        $this->add($password);
    }

    public function addpasswordconfirm()
    {
        $confirmPassword = new \Phalcon\Forms\Element\Password('confirmPassword', [
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
        $this->add($confirmPassword);
    }

    public function addterms()
    {
        $terms = new \Phalcon\Forms\Element\Check('terms', [
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
        $this->add($terms);
    }

    public function addCSRF()
    {
        $csrf = new \Phalcon\Forms\Element\Hidden('csrf', [
            'value' => $this->getToken()
        ]);
        $csrf->addValidator(new Identical(
            [
                'value'   => $this->security->getSessionToken(),
                'message' => ':field validation failed'
            ]
        ));
        $csrf->clear();
        $this->add($csrf);
    }

    public function addsubmit()
    {
        $register = new \Phalcon\Forms\Element\Submit('save');

        $register->setLabel('Sign Up');

        $this->add($register);
    }
}