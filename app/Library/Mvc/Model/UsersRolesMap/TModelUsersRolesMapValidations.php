<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/27/2019
 * Time: 11:57 AM
 */

namespace Lib\Mvc\Model\UsersRolesMap;


use Lib\Mvc\Model\Roles\ModelRoles;
use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Validation;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

trait TModelUsersRolesMapValidations
{
    protected function validation()
    {
        $validator = new Validation();

        $validator->add('user_id',
            new PresenceOf([
                'message' => 'the user_id is required',
                'cancelOnFail' => true
            ])
        );

        $validator->add('user_id',
            new Numericality([
                'message' => 'the :field is not numeric',
                'cancelOnFail' => true
            ])
        );

        $validator->add('user_id',
            new InclusionIn([
                'domain' => array_column(ModelUsers::find()->toArray(),'id'),
                'message' => 'the user is not in the users table',
                'cancelOnFail' => true
            ])
        );
        /*
         * role_id
         */
        $validator->add('role_id',
            new PresenceOf([
                'message' => 'the user_id is required',
                'cancelOnFail' => true
            ])
        );

        $validator->add('role_id',
            new Numericality([
                'message' => 'the :field is not numeric',
                'cancelOnFail' => true
            ])
        );

        $validator->add('role_id',
            new InclusionIn([
                'domain' => array_column(ModelRoles::find()->toArray(),'id'),
                'message' => 'the role is not in the role table',
                'cancelOnFail' => true
            ])
        );

        return $this->validate($validator);
    }
}