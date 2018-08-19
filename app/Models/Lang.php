<?php
/**
 * Summary File Lang
 *
 * Description File Lang
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Ilya\Models;


use Phalcon\Mvc\Model;
use Phalcon\Validation;

class Lang extends Model
{
    public $id;
    public $title;
    public $value;
    public $is_primary;

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\UserFieldsCategory',
            'lang_id',
            [
                'alias' => 'UserFieldsCategories'
            ]
        );
    }

    public function validation()
    {
        $validator = new Validation();

        /**
         * Value
         */
        $validator->add(
            'value',
            new Validation\Validator\Uniqueness(
                [
                    'model' => $this,
                    'message' => 'The inputted ISO language is existing'
                ]
            )
        );
        $validator->add(
            'value',
            new Validation\Validator\PresenceOf(
                [
                    'model' => $this,
                    'message' => 'The value is required'
                ]
            )
        );

        /**
         * title
         */
        $validator->add(
            'title',
            new Validation\Validator\Uniqueness(
                [
                    'model' => $this,
                    'message' => 'The inputted title is existing'
                ]
            )
        );
        $validator->add(
            'title',
            new Validation\Validator\PresenceOf(
                [
                    'model' => $this,
                    'message' => 'title is required'
                ]
            )
        );

        return $this->validationHasFailed() != true;
    }

    public function getSource ()
    {
        return 'ilya_lang';
    }
}