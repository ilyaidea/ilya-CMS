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

use Ilya\Models\Lang;
use Lib\Mvc\Helper\CmsCache;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class Localization extends Plugin
{
    public function __construct (Dispatcher $dispatcher)
    {
        $languages = CmsCache::getInstance()->get('languages');

        /**
         * Set lang default
         */
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

        $langQuery = $this->request->getQuery('lang');
        if (!$langQuery)
        {
            $langParam = $dispatcher->getParam('lang');
        }
        else
        {
            $langParam = $langQuery;
        }

        if (!$langParam)
        {
            $langParam = $langDefault['value'];
        }

        define('LANG', $langParam);

        // Set translate ...
    }
}