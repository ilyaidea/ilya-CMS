<?php
/**
 * Summary File UsersFieldsMap
 *
 * Description File UsersFieldsMap
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:17 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models;



use Lib\Mvc\Model;

class UsersFieldsMap extends Model
{
    public $id;
    public $user_fields_id;
    public $user_id;
    public $content;

    public function init()
    {
        $this->belongsTo(
            'user_id',
            'Modules\Users\Session\Models\Users',
            'id'
        );

        $this->belongsTo(
            'user_fields_id',
            'Modules\Users\Session\Models\UserFields',
            'id'
        );
    }

    public function getSource ()
    {
        return 'ilya_users_fields_map';
    }
}