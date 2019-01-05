<?php
/**
 * Summary File ModelTranslate
 *
 * Description File ModelTranslate
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/20/2018
 * Time: 10:45 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\System\Native\Models\Translate;

use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;

class  ModelTranslate extends Model
{
    use TraitPropertiesTranslate;
    use TraitEventsTranslate;
    use TraitValidationTranslate;

    public function initialize()
    {
        $this->setSource('ilya_translate');
    }
    public static function findCachedByLang($lang = null)
    {
        $translates = self::translates();
        return $translates[$lang];
    }
    public static function translates()
    {
        return CmsCache::getInstance()->get('translates');
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

}