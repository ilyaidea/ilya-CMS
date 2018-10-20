<?php
/**
 * Summary File Translate
 *
 * Description File Translate
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/20/2018
 * Time: 10:45 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\System\Native\Models;


use Lib\Mvc\Helper;
use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;

/**
 * @property Helper helper
 */
class Translate extends Model
{
    public $id;
    private $language;
    private $phrase;
    private $translation;

    public function initialize()
    {
        parent::initialize();
    }

    public static function translates()
    {
        return CmsCache::getInstance()->get('translates');
    }

    public static function findCachedByLang($lang = null)
    {
        $translates = self::translates();
        return $translates[$lang];
    }

    public function findByPhraseAndLang($phrase, $lang = null)
    {
        if (!$lang) {
            $lang = $this->helper->locale()->getLanguage();
        }
        $result = self::findFirst([
            'phrase = :phrase: AND language = :lang:',
            'bind' => [
                'phrase' => $phrase,
                'lang'   => $lang,
            ]
        ]);
        return $result;
    }

    public static function buildCmsTranslatesCache()
    {
        $save = [];
        $languages = Language::find();
        /** @var Language $lang */
        foreach($languages as $lang) {
            $save[$lang->getIso()] = [""=>""];
        }

        $entries = Translate::find();
        /** @var Translate $el */
        foreach ($entries as $el) {
            $save[$el->getLanguage()][$el->getPhrase()] = $el->getTranslation();
        }
        return $save;
    }

    public function getSource()
    {
        return 'ilya_translate';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage( $language )
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @param mixed $phrase
     */
    public function setPhrase( $phrase )
    {
        $this->phrase = \Phalcon\Text::underscore($phrase);
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $translation
     */
    public function setTranslation( $translation )
    {
        $this->translation = $translation;
    }


}