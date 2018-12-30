<?php
/**
 * Summary File ModelLanguage
 *
 * Description File ModelLanguage
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/11/2018
 * Time: 6:08 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Native\Models\Language;

use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;
use Modules\System\Native\Models\Translate;
use Phalcon\Di;
use Phalcon\Mvc\Model\Query\Builder;

class ModelLanguage extends Model
{
    use TraitPropertiesLanguage;
    use TraitValidationLanguage;
    use TraitEventsLanguage;

    public function init()
    {
        $this->setSource('ilya_language');
    }

    public function beforeCreate()
    {
        if(!$this->position)
            $this->position = $this->getUpperPosition() + 1;

        if(!$this->is_primary)
            $this->is_primary = 0;

        if($this->position)
        {
            $langPlusPosition = self::find([
                'conditions' => 'position >= '. $this->position
            ]);

            foreach($langPlusPosition as $lang)
            {
                $lang->position = $lang->position + 1;
                $lang->update();
            }
        }
    }

    public function afterUpdate()
    {
        //        $cache = $this->getDI()->get('cache');
        //        $cache->delete(self::cacheKey());
    }

    public function beforeUpdate()
    {
        //        $cache = $this->getDI()->get('cache');
        //        $cache->delete(self::cacheKey());
    }

    public function afterSave()
    {
        CmsCache::getInstance()->save('languages', $this->buildCmsLanguagesCache());
        CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
    }

    public function afterDelete()
    {
        CmsCache::getInstance()->save('languages', $this->buildCmsLanguagesCache());
        CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
    }

    public function beforeDelete()
    {
        if($this->is_primary)
        {
            return false;
        }
    }

    private function buildCmsLanguagesCache()
    {
        $modelsManager = Di::getDefault()->get('modelsManager');

        /** @var Builder $qb */
        $qb = $modelsManager->createBuilder();
        $qb->from(self::class);
        $qb->orderBy('is_primary DESC, position ASC');

        $entries = $qb->getQuery()->execute();
        $save = [];
        if ($entries->count()) {

            /** @var ModelLanguage $el */
            foreach ($entries as $el) {
                $save[$el->getIso()] = [
                    'id'         => $el->getId(),
                    'iso'        => $el->getIso(),
                    'title'       => $el->getTitle(),
                    'is_primary'    => $el->getIsPrimary(),
                    'position'    => $el->getPosition(),
                    'direction'    => $el->getDirection(),
                ];
            }
        }
        return $save;
    }

    public function afterValidation()
    {
//        if (!$this->position) {
//            $this->position = $this->getUpperPosition();
//        }

    }

    public function afterValidationOnCreate()
    {
//        $this->position = $this->getUpperPosition() + 1;
    }

    public static function findCachedLanguages()
    {
        return CmsCache::getInstance()->get('languages');
    }

    public static function findCachedLanguagesIso()
    {
        $languages = self::findCachedLanguages();
        $iso_array = [];
        if (!empty($languages)) {
            foreach ($languages as $lang) {
                $iso_array[] = $lang['iso'];
            }
        }
        return $iso_array;
    }

    public static function findCachedByIso($iso)
    {
        $languages = self::findCachedLanguages();
        foreach ($languages as $lang) {
            if ($iso == $lang['iso']) {
                return $lang;
            }
        }
    }

    public static function cacheKey()
    {
        return HOST_HASH . md5('ModelLanguage::findCachedLanguages');
    }

    public function getUpperPosition()
    {
        $count = self::count();
        return $count;
    }

    public function setOnlyOnePrimary()
    {
        if ($this->getIsPrimary() == 1) {
            $languages = $this->find();
            /** @var ModelLanguage $lang */
            foreach ($languages as $lang) {
                if ($lang->getId() != $this->getId()) {
                    $lang->setIsPrimary(0);
                    $lang->save();
                }
            }
        } else {
            $primary = $this->findFirst("is_primary = '1'");
            if (!$primary) {
                $this->setIsPrimary(1);
                $this->save();
                $this->getDI()->get('flash')->notice('There should always be a primary language');
            }
        }
    }

    public static function positionOptions()
    {

        $positionOptions = [];
        $previous = null;
        $passedself = false;

        $languages = self::find([
            'columns' => 'id, title, position'
        ])->toArray();

        foreach($languages as $language)
        {
            if(isset($previous))
            {
                $positionHtml = 'after '. (($passedself ? $language['title'] : $previous['title']));
            }
            else
            {
                $positionHtml = 'First';
            }

            $positionOptions[$language['position']] = $positionHtml;

            $previous = $language;
        }

        return $positionOptions;
    }

    public static function findAllForDataTable()
    {
        $langs = self::findCachedLanguages();

        $row = [];
        foreach($langs as $lang)
        {
            $col = [];
            if(is_array($lang))
            {
                foreach($lang as $key => $value)
                {
                    if($key == 'is_primary')
                    {
                        if($value)
                        {
                            $col[$key]['display'] = "Yes";
                        }
                        else
                        {
                            $col[$key]['display'] = "NO";
                        }
                        $col[$key]['value'] = $value;
                    }
                    else
                    {
                        $col[$key] = $value;
                    }

                }
            }
            $row[] = $col;
        }

        return $row;
    }

}