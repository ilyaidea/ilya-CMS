<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/27/2019
 * Time: 9:47 AM
 */

namespace Lib\Mvc\Model\Roles;


use Lib\Validation;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

trait TModelRolesValidations
{
    public function validation()
    {
        $validator = new Validation();
        /*
         * name
         */
        $validator->add('name',
            new PresenceOf([
                'message' => 'this_field_is_required',
                'cancelOnFail' => true
            ])
        );
        $validator->add('name',
            new Uniqueness([
            'model' => new ModelRoles(),
            'message' => 'The inputted role is existing',
            'cancelOnFail' => true
        ]));

        $validator->add('name',
            new StringLength([
                "max"            => 30,
                "min"            => 2,
                "messageMaximum" => "name is too long!",
                "messageMinimum" => "name is too short!",
                'cancelOnFail' => true
            ])
        );
        /*
         * description
         */
        $validator->add('description',
            new StringLength(
                [
                    "max"            => 200,
                    "min"            => 2,
                    "messageMaximum" => "description is too long!",
                    "messageMinimum" => "description is too short!",
                    'allowEmpty' => true,
                    'cancelOnFail' => true
                ] )
        );

        /*
         * parent_id
         */
        $validator->add('parent_id',
            new Numericality([
                'message' => 'the :field is not numeric',
                'allowEmpty' => true,
                'cancelOnFail' => true
            ])
        );

        $validator->add('parent_id',
            new InclusionIn([
                'domain' => array_column(ModelRoles::find()->toArray(),'id','id'),
                'message' => 'the parent role must be in domain',
                'allowEmpty' => true,
                'cancelOnFail' => true
            ]));

        return $this->validate($validator);
    }
}