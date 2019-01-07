<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 1/1/2019
 * Time: 12:04 PM
 */

namespace Modules\System\PageManager\Models\Keywords;


use Modules\System\PageManager\Models\Pages\ModelPages;

trait TraitRelationsKewordsModel
{
    protected function relations()
    {
        $this->belongsTo(
            'page_id',
            ModelPages::class,
            'id'
        ,
        [
            'alias' => 'Page'
        ]
        );
    }
}