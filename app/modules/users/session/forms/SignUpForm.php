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
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class SignUpForm extends \Phalcon\Forms\Form
{
    public function initialize($entity = null, $options = null)
    {
        // Username
        $username = new \Phalcon\Forms\Element\Text('username', [
            'class' => 'form-control',
            'placeholder' => 'Choose username',
            'type' => 'text'
        ]);
        $username->addValidators([
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

        // Email
        $email = new \Phalcon\Forms\Element\Text('email', [
            'class' => 'form-control',
            'placeholder' => 'Your Email Address',
            'type'        => 'text'
        ]);
        $email->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The :field is required'
                    ]
                ),
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
                )
            ]
        );
        $this->add($email);

        // Password
        $password = new \Phalcon\Forms\Element\Password('password', [
            'class' => 'form-control',
            'placeholder' => 'Enter Password',
            'type'        => 'password'
        ]);
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

        // Confirm password
        $confirmPassword = new \Phalcon\Forms\Element\Password('confirmPassword', [
            'class' => 'form-control',
            'placeholder' => 'Confirm password',
            'type'        => 'password'
        ]);
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

        // Terms
        $terms = new \Phalcon\Forms\Element\Check('terms', [
            'value' => 'yes',
            'type'  => 'checkbox'
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

        // CSRF
        $csrf = new \Phalcon\Forms\Element\Hidden('csrf', [
            'type' => 'hidden'
        ]);
        $csrf->addValidator(new Identical(
            [
                'value'   => $this->security->getSessionToken(),
                'message' => ':field validation failed'
            ]
        ));
        $csrf->clear();
        $this->add($csrf);

        // Submit
        $this->add(new \Phalcon\Forms\Element\Submit('Sign up', [
            'class' => 'btn btn-primary btn-md btn-block waves-effect text-center m-b-20',
            'type'  => 'submit'
        ]));

    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }

}