<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/27/2019
 * Time: 11:21 AM
 */

namespace Modules\System\Native\Models\Translate;


use Modules\System\Native\Models\Language\ModelLanguage;

trait TraitRelationsTranslate
{
    protected function relations()
    {
        $this->belongsTo(
            'language',
            ModelLanguage::class,
            'iso'
        );

    }

}