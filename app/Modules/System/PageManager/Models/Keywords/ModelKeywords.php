<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 1/1/2019
 * Time: 11:35 AM
 */
namespace Modules\System\PageManager\Models\Keywords;

use Lib\Events\IModelEvents;
use Lib\Forms\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Model;
use Modules\System\PageManager\Models\Pages\ModelPages;

class ModelKeywords extends Model implements IModelEvents
{
    use TraitPropertiesKeywordsModel;
    use TraitEventsKewordsModel;
    use TraitValidationsKeywordsModel;
    use TraitRelationsKewordsModel;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('ilya_pages_keywords');
    }

    /**************************************************************************
     * Static Methods
     */

    public static function saveKeywords($pageId, $keyword)
    {
        $keywords = str_replace(',', '-', $keyword);
        $keywords = str_replace('_', ' ', $keywords);
        $keywords = explode('-',$keywords);

        foreach ($keywords as $keyw )
        {
            $inst = new self();
            $inst->setPageId($pageId);
            $inst->setTitle((trim($keyw)));
            $inst->save();
        }
    }

}
