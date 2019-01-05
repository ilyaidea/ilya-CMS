<?php
/**
 * Summary File UserFields
 *
 * Description File UserFields
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:07 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models;


use Lib\Mvc\Model;

class UserFields extends Model
{
    public $id;
    public $user_fields_category_id;
    public $title;
    public $content;
    public $position;
    public $flags;
    public $permit;

    public function init ()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\UsersFieldsMap',
            'user_fields_id',
            [
                'alias' => 'UsersFieldsMaps'
            ]
        );

        $this->hasManyToMany(
            'id',
            'Modules\Users\Session\Models\UsersFieldsMap',
            'user_field_id', 'user_id',
            'Modules\Users\Session\Models\Users',
            'id',
            [
                'alias' => 'Users'
            ]
        );

        $this->belongsTo(
            'user_fields_category_id',
            'Modules\Users\Session\Models\UserFieldsCategory',
            'id',
            [
                'alias' => 'Category'
            ]
        );
    }

    public function getSource ()
    {
        return 'ilya_users_fields';
    }
}