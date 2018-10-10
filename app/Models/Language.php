<?php
/**
 * Summary File Lang
 *
 * Description File Lang
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Ilya\Models;


use Lib\Mvc\Helper\CmsCache;
use Phalcon\Di;
use Phalcon\Mvc\Model;
use Phalcon\Validation;

class Language extends Model
{
    public $id;
    public $iso;
    public $name;
    public $position;
    public $is_primary;

    public function initialize()
    {
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
            'message' => 'ISO is required'
        ] ) );

        /**
         * Name
         */
        $validator->add('name', new Validation\Validator\Uniqueness([
            'model' => $this,
            "message" => "The inputted name is existing"
        ]));
        $validator->add('name', new Validation\Validator\PresenceOf([
            'model' => $this,
            'message' => 'Name is required'
        ]));

        return $this->validationHasFailed() != true;
    }

    public function afterCreate()
    {
        $this->position = $this->getUpperPosition() + 1;

    }

    public function afterUpdate()
    {
//        $cache = $this->getDI()->get('cache');
//        $cache->delete(self::cacheKey());
    }

    public function afterSave()
    {
        CmsCache::getInstance()->save('languages', $this->buildCmsLanguagesCache());
//        CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
    }

    public function afterDelete()
    {
        CmsCache::getInstance()->save('languages', $this->buildCmsLanguagesCache());
//        CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
    }

    private function buildCmsLanguagesCache()
    {
        $modelsManager = Di::getDefault()->get('modelsManager');

        /** @var Model\Query\Builder $qb */
        $qb = $modelsManager->createBuilder();
        $qb->from('Ilya\Models\Language');
        $qb->orderBy('is_primary DESC, position ASC');

        $entries = $qb->getQuery()->execute();
        $save = [];
        if ($entries->count()) {

            /** @var Language $el */
            foreach ($entries as $el) {
                $save[$el->getIso()] = [
                    'id'         => $el->getId(),
                    'iso'        => $el->getIso(),
                    'name'       => $el->getName(),
                    'primary'    => $el->getIsPrimary(),
                ];
            }
        }
        return $save;
    }

    public function afterValidation()
    {
        if (!$this->position) {
            $this->position = $this->getUpperPosition();
        }

    }

    public function afterValidationOnCreate()
    {
        $this->position = $this->getUpperPosition() + 1;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name )
    {
        $this->name = $name;
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
}