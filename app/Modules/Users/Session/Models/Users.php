<?php
/**
 * Summary File Users
 *
 * Description File Users
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:04 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Users\Session\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;
    public $email;
    public $username;

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\UsersFieldsMap',
            'user_id',
            [
                'alias' => 'UsersFieldsMaps'
            ]
        );

        $this->hasManyToMany(
            'id',
            'Modules\Users\Session\Models\UsersFieldsMap',
            'user_id', 'user_fields_id',
            'Modules\Users\Session\Models\UserFields',
            'id',
            [
                'alias' => 'UserFields'
            ]
        );
    }

    public function getSource ()
    {
        return 'ilya_users';
    }
}