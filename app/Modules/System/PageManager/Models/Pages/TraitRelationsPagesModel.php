<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 1/1/2019
 * Time: 11:19 AM
 */

namespace Modules\System\PageManager\Models\Pages;


use Modules\System\Native\Models\Language\ModelLanguage;
use Modules\System\PageManager\Models\Keywords\ModelKeywords;

trait TraitRelationsPagesModel
{
    protected function relations()
    {
        $this->belongsTo(
            'parent_id',
            self::class,
            'id',
            [
                'alias' => 'Parent',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message' => 'The parent_id does not exist'
                ]
            ]
        );

        $this->belongsTo(
            'language',
            ModelLanguage::class,
            'iso',
            [
                'alias' => 'Language'
            ]
        );

        $this->hasMany(
            'id',
            ModelKeywords::class,
            'page_id'
            ,
            [
                'alias' => 'Keyword'
            ]
        );

        $this->hasMany(
            'id',
            self::class,
            'parent_id',
            [
                'alias' => 'Childs',
                'foreignKey' => [
                    'message' => 'The Page could not be deletet because other pages are using it'
                ]
            ]
        );
    }

}