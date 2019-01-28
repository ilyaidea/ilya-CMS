<?php
/**
 * Summary File TModelUsersRelations
 *
 * Description File TModelUsersRelations
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/24/2018
 * Time: 6:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Users;

use Lib\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

trait TModelUsersValidations
{
    protected function validation()
    {
        $validator = new Validation();

       /*
        * email
        */
        $validator->add('email',
        new Email([
            'massage' => 'The e-mail is not valid',
            'cancelOnFail' => true
         ])
        );

        $validator->add('email',
            new PresenceOf([
                'massage' => 'The e-mail is required',
                'cancelOnFail' => true
            ])
        );

        /*
         * username
         */
        $validator->add('username',
            new PresenceOf([
                'massage' => 'The username is required',
                'cancelOnFail' => true
            ])
        );

        $validator->add('username',
            new StringLength( [
                "max"            => 20,
                "min"            => 2,
                "messageMaximum" => "username is too long!",
                "messageMinimum" => "username is too short!",
                'cancelOnFail' => true
            ] )
        );

        $validator->add('username',
            new Uniqueness([
                'model' => new ModelUsers(),
                'message' => 'The inputted username is existing',
                'cancelOnFail' => true
            ])
        );

        return $this->validate($validator);
    }
}