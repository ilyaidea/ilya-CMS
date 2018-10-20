<?php
/**
 * Summary File Language
 *
 * Description File Language
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/11/2018
 * Time: 6:08 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Native\Models;

use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;
use Phalcon\Di;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Validation;

class Language extends Model
{
    protected $id;
    protected $iso;
    protected $title;
    protected $position;
    protected $is_primary;
    protected $direction;

    public function initialize()
    {
        parent::initialize();
    }

    public function getSource()
    {
        return 'ilya_language';
    }

    public function validation()
    {
        $validator = new Validation();

        /**
         * ISO
         */
        $validator->add( 'iso', new Validation\Validator\Uniqueness( [
            'model'   => $this,
            'message' => 'The inputted ISO language is existing'
        ] ) );
        $validator->add( 'iso', new Validation\Validator\PresenceOf( [
            'model'   => $this,
            'message' => 'ISOOO is required'
        ] ) );

        /**
         * Name
         */
        $validator->add('title', new Validation\Validator\Uniqueness([
            'model' => $this,
            "message" => "The inputted title is existing"
        ]));
        $validator->add('title', new Validation\Validator\PresenceOf([
            'model' => $this,
            'message' => 'Name is required'
        ]));

        return $this->validate($validator);
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
        $qb->from('Modules\System\Native\Models\Language');
        $qb->orderBy('is_primary DESC, position ASC');

        $entries = $qb->getQuery()->execute();
        $save = [];
        if ($entries->count()) {

            /** @var Language $el */
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
        return HOST_HASH . md5('Language::findCachedLanguages');
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
            /** @var Language $lang */
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id )
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param mixed $iso
     */
    public function setIso( $iso )
    {
        $this->iso = $iso;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle( $title )
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition( $position )
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getIsPrimary()
    {
        return $this->is_primary;
    }

    /**
     * @param mixed $is_primary
     */
    public function setIsPrimary( $is_primary )
    {
        $this->is_primary = $is_primary;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection( $direction )
    {
        $this->direction = $direction;
    }


}