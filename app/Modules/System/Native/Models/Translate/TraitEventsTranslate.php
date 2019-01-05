<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 12/31/2018
 * Time: 8:31 AM
 */

namespace Modules\System\Native\Models\Translate;

use Lib\Mvc\Helper\CmsCache;
use Modules\System\Native\Models\Language\ModelLanguage;

trait TraitEventsTranslate
{
    public function afterSave()
    {
         CmsCache::getInstance()->save('translates', self::buildCmsTranslatesCache());

    }
    public function afterDelete()
    {
        CmsCache::getInstance()->save('translates', self::buildCmsTranslatesCache());
    }

    public static function buildCmsTranslatesCache()
    {
        $save = [];
        $languages = ModelLanguage::find();
        /** @var ModelLanguage $lang */
        foreach($languages as $lang) {
            $save[$lang->getIso()] = [""=>""];
        }

        $entries = ModelTranslate::find();
        /** @var ModelTranslate $el */
        foreach ($entries as $el) {
            $save[$el->getLanguage()][$el->getPhrase()] = $el->getTranslation();
        }
        return $save;
    }

}