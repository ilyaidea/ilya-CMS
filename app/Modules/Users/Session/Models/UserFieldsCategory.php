<?php
/**
 * Summary File UserFieldsCategory
 *
 * Description File UserFieldsCategory
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models;


use Lib\Mvc\Model;
use Lib\Mvc\Model\BaseModel;
use Lib\Validation\Validation;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;

class UserFieldsCategory extends Model
{
    public $id;
    public $title;
    public $content;
    public $lang_id;
    public $position;

    public function init()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\UserFields',
            'user_fields_category_id',
            [
                'alias' => 'Fields',
            ]
        );

        $this->belongsTo(
            'lang_id',
            'Ilya\Models\Lang',
            'id',
            [
                'alias' => 'Lang'
            ]
        );

//        die(print_r($this->getEditor()->get()));
    }

    public function getSource ()
    {
        return 'ilya_users_fields_category';
    }

    /**
     * Summary Function validation
     *
     * Description Function validation
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function validation ()
    {
        $validator = new Validation();
        $validator->add(
            'title',
            new Uniqueness(
                [
                    'message' => 'jjjj',
                    'domain' => []
                ]
            )
        );

        $validator->add(
            'title',
            new PresenceOf(
                [
                    'message' => 'requeeee'
                ]
            )
        );

        $validator->add(
            'id',
            new Uniqueness(
                [
                    'message' => 'iddddddd'
                ]
            )
        );

        $this->validate($validator);
    }
}