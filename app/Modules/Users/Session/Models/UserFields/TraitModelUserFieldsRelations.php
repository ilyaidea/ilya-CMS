<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 11:36 AM
 */

namespace Modules\Users\Session\Models\UserFields;


trait TraitModelUserFieldsRelations
{
    public function init()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\ModelUsersFieldsMap',
            'user_fields_id',
            [
                'alias' => 'UsersFieldsMaps'
            ]
        );

        $this->hasManyToMany(
            'id',
            'Modules\Users\Session\Models\ModelUsersFieldsMap',
            'user_field_id', 'user_id',
            'Modules\Users\Session\Models\Users',
            'id',
            [
                'alias' => 'Users'
            ]
        );

        $this->belongsTo(
            'user_fields_category_id',
            'Modules\Users\Session\Models\ModelUserFieldsCategory',
            'id',
            [
                'alias' => 'Category'
            ]
        );
    }

}