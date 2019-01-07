<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 1/1/2019
 * Time: 11:35 AM
 */
namespace Modules\System\PageManager\Models\Keywords;

use Lib\Events\IModelEvents;
use Lib\Mvc\Model;

class ModelKeywords extends Model implements IModelEvents
{
    use TraitPropertiesKeywordsModel;
    use TraitEventsKewordsModel;
    use TraitValidationsKeywordsModel;
    use TraitRelationsKewordsModel;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('ilya_pages_kewords');
    }
}
