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
        $this->setDefaultModule('base');
        $this->setDefaultController('index');
        $this->setDefaultAction('index');

        $this->add('/:module/:controller/:action/:params(|/)', [
            'module'     => 1,
            'controller' => 2,
            'action'     => 3,
            'params'     => 4
        ])->setName('default');

        $this->add('/:module/:controller(|/)', [
            'module'     => 1,
            'controller' => 2,
            'action'     => 'index'
        ])->setName('default_action');

        $this->add('/:module(|/)', [
            'module'     => 1,
            'controller' => 'index',
            'action'     => 'index'
        ])->setName('default_controller');
    }

    public function addForLang($pattern, $paths = null, $name)
    {
        $languages = [
            'fa' => []
        ];

        foreach ($languages as $lang=>$items)
        {
            if (isset($items['primary']) && $items['primary'])
            {
                $this->add($pattern, $paths)->setName(self::LANG_PREFIX. $name. '_'. $lang);
            }
            else
            {
                $this->add('/'. $lang. $pattern, $paths)->setName(self::LANG_PREFIX. $name. '_'. $lang);
            }
        }
    }
}