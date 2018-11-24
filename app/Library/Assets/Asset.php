<?php
/**
 * Summary File Asset
 *
 * Description File Asset
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/18/2018
 * Time: 8:15 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Assets;


use Lib\Assets\Minify\CSS;
use Lib\Assets\Minify\JS;
use Lib\Mvc\Helper\CmsCache;
use Phalcon\Mvc\User\Component;

/**
 * @property CSS cssmin
 * @property JS jsmin
 */
class Asset extends Component
{
//    private static $instance = null;
    private $key;
    private $css = [];
    private $js = [];

    public function __construct()
    {
        $this->key = $this->getHashKey();
    }

    public function addCss($_, $name = null)
    {
        if(is_array($_))
            $this->css = array_merge($this->css, $_);
        elseif($name !== null && is_string($name))
        {
            $this->css[$name] = $_;
        }
        else
            $this->css[$_] = $_;
    }

    public function getCss($name = null, $onlyValues = true)
    {
        if($name !== null && is_string($name))
            return $this->css[$name];

        if(!$onlyValues)
            return $this->css;

        return array_values($this->css);
    }

    public function addJs($_, $name = null)
    {
        if(is_array($_))
            $this->js = array_merge($this->js, $_);
        elseif($name !== null && is_string($name))
            $this->js[$name] = $_;
        else
            $this->js[$_] = $_;
    }

    public function getJs($name = null, $onlyValues = true)
    {
        if($name !== null && is_string($name))
            return $this->js[$name];

        if(!$onlyValues)
            return $this->js;

        return array_values($this->js);
    }

    public function process()
    {
        $cssSize = 0;
        if(!empty($this->css))
        {
            foreach($this->css as $css )
            {
                if (filter_var($css, FILTER_VALIDATE_URL) == true) {
                    $this->assets->addCss($css, false);
                    continue;
                }
                if(!file_exists($css))
                {
                    $this->assets->addInlineCss($css);
                    $cssSize += strlen($css);
                }
                else
                {
                    $this->assets->addCss($css);
                    $cssSize += filesize($css);
                }

                $this->cssmin->add($css);
            }
        }

        if($cssSize !== CmsCache::getInstance()->get($this->key. '.css'))
        {
//            $this->cssmin->minify('tmp/'. $this->key.'.css');
//            CmsCache::getInstance()->save($this->key.'.css', $cssSize);
        }

        $jsSize = 0;
        if(!empty($this->js))
        {
            foreach($this->js as $js )
            {
                if (filter_var($js, FILTER_VALIDATE_URL) == true) {
                    $this->assets->addJs($js, false);
                    continue;
                }
                if(!file_exists($js))
                {
                    $this->assets->addInlineJs($js);
                    $jsSize += strlen($js);
                }
                else
                {
                    $this->assets->addJs($js);
                    $jsSize += filesize($js);
                }

                $this->jsmin->add($js);
            }
        }

        if($jsSize !== CmsCache::getInstance()->get($this->key. '.js'))
        {
//            $this->jsmin->minify( 'tmp/'. $this->key.'.js');
//            CmsCache::getInstance()->save($this->key.'.js', $jsSize);
        }

//        $this->assets->addCss('tmp/'. $this->key.'.css');
//        $this->assets->addJs('tmp/'. $this->key.'.js');
    }

    protected function getHashKey()
    {
        return
            HOST_HASH.
            $this->dispatcher->getParam('lang').
            md5(
                $this->dispatcher->getControllerClass().
                '\\'.
                $this->dispatcher->getActionName());
    }
}