<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 12:03 PM
 */

namespace Modules\Users\Session\Models\UserFieldsMap;


trait TraitModelUserFieldsMapRelations
{
    public function init()
    {
        $this->belongsTo(
            'user_id',
            'Modules\Users\Session\Models\Users',
            'id'
        );

        $this->belongsTo(
            'user_fields_id',
            'Modules\Users\Session\Models\ModelUserFields',
            'id'
        );
    }

}