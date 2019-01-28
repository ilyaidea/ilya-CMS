<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/27/2019
 * Time: 11:29 AM
 */

namespace Modules\System\Native\Models\Language;

use Modules\System\Native\Models\Translate\ModelTranslate;

trait TraitRelationsLanguage
{
    protected function relations()
    {
        $this->hasMany(
            'iso',
            ModelTranslate::class,
            'language'
        );

    }

}