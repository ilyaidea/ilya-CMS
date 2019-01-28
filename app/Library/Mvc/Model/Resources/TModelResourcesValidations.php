<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/27/2019
 * Time: 10:50 AM
 */

namespace Lib\Mvc\Model\Resources;

use Lib\Mvc\Model\Roles\ModelRoles;
use Lib\Validation;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength;

trait TModelResourcesValidations
{
    protected function validation()
    {
        $validator = new Validation();

        /*
         * role_id
         */
        $validator->add('role_id',
            new PresenceOf([
                'message' => 'the field is required',
                'cancelOnFail' => true
            ])
        );

        $validator->add('role_id',
         new Numericality([
             'message' => 'the :field must be a number',
             'cancelOnFail' => true
         ])
        );

        $domainRole = array_column( ModelRoles::find()->toArray(),'id','id');
        $validator->add('role_id',
            new InclusionIn([
                'domain' =>$domainRole ,
                'message' => 'the :field must exist in the role table',
                'cancelOnFail' => true
            ])
        );

        /*
         * controller
         */
        $validator->add('controller',
            new PresenceOf([
                'message' => 'the field is required',
                'cancelOnFail' => true
            ])
        );
        $validator->add('controller',
            new StringLength(
                [
                    "max"            => 100,
                    "min"            => 2,
                    "messageMaximum" => "controller name is too long!",
                    "messageMinimum" => "controller name is too short!",
                    'cancelOnFail' => true
                ] )
        );

        /*
         * action
         */
        $validator->add('action',
            new PresenceOf([
                'message' => 'the field is required',
                'cancelOnFail' => true
            ])
        );

        $validator->add('action',
            new StringLength(
                [
                    "max"            => 20,
                    "min"            => 2,
                    "messageMaximum" => "action name is too long!",
                    "messageMinimum" => "action name is too short!",
                    'cancelOnFail' => true
                ] )
        );

        return $this->validate($validator);
    }
}