<?php
/**
 * Summary File TModelOptionsEvents
 *
 * Description File TModelOptionsEvents
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/3/2019
 * Time: 11:40 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Options;


use Lib\Mvc\Helper\CmsCache;

trait TModelOptionsEvents
{
    public function afterSave()
    {
        CmsCache::getInstance()->save('options', $this->buildOptionsCache());
    }

    public function afterDelete()
    {
        CmsCache::getInstance()->save('options', $this->buildOptionsCache());
    }

    private function buildOptionsCache()
    {
        $options = self::find();

        $save = [];

        /** @var self $option */
        foreach($options as $option)
        {
            $save[$option->getKey()] = $option->getValue();
        }

        return $save;
    }
}