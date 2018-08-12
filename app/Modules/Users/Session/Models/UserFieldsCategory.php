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


use Phalcon\Mvc\Model;

class UserFieldsCategory extends Model
{
    public $id;
    public $title;
    public $content;
    public $lang_id;
    public $position;

    public function initialize()
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
    }

    public function getSource ()
    {
        return 'ilya_user_fields_category';
    }
}