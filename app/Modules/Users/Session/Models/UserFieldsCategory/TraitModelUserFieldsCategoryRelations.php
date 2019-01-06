<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 11:44 AM
 */

namespace Modules\Users\Session\Models\UserFieldsCategory;


trait TraitModelUserFieldsCategoryRelations
{

    public function init()
    {
        $this->hasMany(
            'id',
            'Modules\Users\Session\Models\ModelUserFields',
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
}