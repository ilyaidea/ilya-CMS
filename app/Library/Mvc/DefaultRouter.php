<?php
/**
 * Summary File DefaultRouter
 *
 * Description File DefaultRouter
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/14/2018
 * Time: 10:38 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc;

use Lib\Mvc\Helper\CmsCache;
use Phalcon\Mvc\Router;

class DefaultRouter extends \Phalcon\Mvc\Router
{
    const LANG_PREFIX = 'LP_';

    public function __construct($defaultRoutes = true)
    {
        parent::__construct($defaultRoutes);
        $this->setDefaultRoutes();
    }

    private function setDefaultRoutes()
    {
//        dump(CmsCache::getInstance()->get('languages'));
//        $languages = CmsCache::getInstance()->get('languages');

        $this->setDefaultController('index');
        $this->setDefaultAction('index');

        $this->addd(
            '/:module/:controller/:action/:params(|/)',
            [
            'module'     => 1,
            'controller' => 2,
            'action'     => 3,
            'params'     => 4
            ],
            'default'
        );

        $this->addd(
            '/:module/:controller(|/)',
            [
            'module'     => 1,
            'controller' => 2,
            'action'     => 'index'
            ],
            'default_action'
        );

        $this->addd(
            '/:module(|/)',
            [
            'module'     => 1,
            'controller' => 'index',
            'action'     => 'index'
            ],
            'default_controller'
        );
    }


        public function addd($pattern, $paths = null, $name)
        {
            $languages = CmsCache::getInstance()->get('languages');

            foreach ($languages as $language)
            {
                $paths['lang'] = $language['iso'];
                if (isset($language['is_primary']) && $language['is_primary'])
                {
                    $this->add($pattern, $paths)->setName($name. '__'. $language['iso']);
                }
                else
                {
                    $newPattern = '/'. $language['iso']. $pattern;
                    $this->add($newPattern, $paths)->setName($name. '__'. $language['iso']);
                }
            }
        }
}