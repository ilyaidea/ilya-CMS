<?php
/**
 * Summary File Options
 *
 * Description File Options
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/23/2018
 * Time: 12:13 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Model\Options;

use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;

class ModelOptions extends Model
{
    use TModelOptionsProperties;
    use TModelOptionsEvents;

    public function init()
    {
        $this->setDbRef(true);
        $this->setSource('ilya_options');

    }

    public static $keys = [
        'DEBUG_MODE'        => 1,
        'TECHNICAL_WORKS'   => 1,
        'PROFILER'          => 1,
        'WIDGETS_CACHE'     => 1,
        'DISPLAY_CHANGELOG' => 1,
        'ADMIN_EMAIL'       => 'webmaster@localhost',
    ];

    public static function findCacheByKey($key)
    {
        if(CmsCache::getInstance()->get('options'))
        {
            if(strlen($key))
            {
                if(array_key_exists($key, CmsCache::getInstance()->get('options')))
                    return CmsCache::getInstance()->get('options')[$key];
            }
        }

        /** @var self $option */
        $option = self::findFirst([
            'conditions' => 'key = :key:',
            'bind' => [
                'key' => $key
            ]
        ]);
        if($option)
        {
            return $option->getValue();
        }

        return null;
    }
}