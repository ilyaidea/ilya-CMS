<?php
/**
 * Summary File Helper
 *
 * Description File Helper
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/14/2018
 * Time: 8:32 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc;

use Lib\Common\ModuleName;
use Lib\Mvc\Helper\Content\ContentBuilder;
use Lib\Mvc\Helper\HtmlTags;
use Lib\Mvc\Helper\Locale;
use Lib\Mvc\Helper\Meta;
use Lib\Mvc\Helper\SidebarMenu;
use Lib\Mvc\Helper\Title;
use Lib\Widget\Proxy;
use Phalcon\Mvc\User\Component;

class Helper extends Component
{
    private $context = [];

    public function isRTL()
    {
        if($this->locale()->getDirection() === 'rtl')
            return true;

        return false;
    }

    public function title($title = null, $h1 = false)
    {
        return Title::getInstance($title, $h1);
    }

    public function meta()
    {
        return Meta::getInstance();
    }

    public function locale()
    {
        return Locale::getInstance();
    }

    public function sidebarMenu()
    {
        return SidebarMenu::getInstance();
    }

    public function widget($catModule, $moduleName, $params = [])
    {
        return new Proxy($catModule, $moduleName, $params);
    }

    public function modulePartial($template, $data, $category, $module = null)
    {
        $view = clone $this->getDi()->get('view');
        $partialsDir = '';
        if ($module) {
            $moduleName = ModuleName::camelize($module);
            $partialsDir = APP_PATH. 'modules/'.strtolower($category).'/' . $moduleName . '/views/';
        }
        $view->setPartialsDir($partialsDir);

        return $view->partial($template, $data);
    }

    public function htmlTags()
    {
        return HtmlTags::getInstance();
    }

    /**
     * Return HTML representation of $string, work well with blocks of text if $multiline is true
     * @param $string
     * @param bool $multiline
     * @return mixed|string
     */
    function html($string, $multiline = false)
    {
        $html = htmlspecialchars((string)$string);

        if ($multiline) {
            $html = preg_replace('/\r\n?/', "\n", $html);
            $html = preg_replace('/(?<=\s) /', '&nbsp;', $html);
            $html = str_replace("\t", '&nbsp; &nbsp; ', $html);
            $html = nl2br($html);
        }

        return $html;
    }

    public function content()
    {
        return ContentBuilder::getInstance();
    }

    public function partDiv($key)
    {
        $partdiv = (
            strpos($key, 'form') === 0
        );

        return $partdiv;
    }

    public function output_raw($html)
    {
        if (strlen($html))
            echo str_repeat("\t", max(0, $this->indent)) . $html . "\n";
    }

    /**
     * Set some context, which be accessed via $this->context for a function to know where it's being used on the page.
     * @param $key
     * @param $value
     */
    public function setContext($key, $value)
    {
        $this->context[$key] = $value;
    }

    /**
     * Clear some context (used at the end of the appropriate loop).
     * @param $key
     */
    public function clearContext($key)
    {
        unset($this->context[$key]);
    }
}