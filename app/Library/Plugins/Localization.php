<?php
/**
 * Summary File Localization
 *
 * Description File Localization
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/18/2018
 * Time: 9:33 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Plugins;

use Lib\Mvc\Helper;
use Lib\Mvc\Helper\CmsCache;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Lib\Translate\Adapter\NativeArray;

/**
 * Summary Class Localization
 *
 * Description Class Localization
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Lib\Plugins
 * @version 1.0.0
 * @example Desc <code></code>
 * @property Helper $helper
 */
class Localization extends Plugin
{
    public function __construct (Dispatcher $dispatcher)
    {
        $languages = CmsCache::getInstance()->get('languages');

        /**
         * Set lang default
         */
        $langDefault = $this->getLangDefault($languages);

        $langQuery = $this->request->getQuery('lang');
        if (!$langQuery)
        {
            $langParam = $dispatcher->getParam('lang');
        }

        if (!$langParam)
        {
            $langParam = $langDefault['iso'];
        }

        $this->helper->locale()->setLanguage($langParam);
        $this->helper->locale()->setDirection($languages[$langParam]['direction']);

        $translates = CmsCache::getInstance()->get('translates')[$langParam];
        $this->getDI()->setShared('translate', new NativeArray([
            'content' => $translates
        ]));
    }

    private function getLangDefault($languages)
    {
        $langDefault = null;
        if (is_array($languages) || $languages instanceof \Traversable)
        {
            foreach ($languages as $language)
            {
                if ($language['is_primary'])
                {
                    $langDefault = $language;
                    break;
                }
            }
        }

        return $langDefault;
    }
}