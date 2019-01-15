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
    private $translate = null;
    private $template = [];

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

    public function t($string, $placeholders = null)
    {
        if (!$this->translate) {
            $this->translate = $this->getDi()->getShared('translate');
        }
        return $this->translate->query($string, $placeholders);
    }

    public function sidebarMenu()
    {
        return SidebarMenu::getInstance();
    }

    public function widget($namespace, $params = [])
    {
        return new Proxy($namespace, $params, $this->isLoadInOwnModule($namespace));
    }

    /*
         * آیا ویجت در ماژول خودش لود شده است.
     */
    private function isLoadInOwnModule($namespace)
    {
        $expload = explode('\\', $namespace);
        $row = [];

        foreach($expload as $key=>$value)
        {
            if($value === 'Widgets')
                break;

            $row[] = $value;

        }

        if(isset($this->config->module->namespace) && $this->config->module->namespace === implode('\\', $row))
        {
            return null;
        }

        return [
            'namespace' => implode('\\', $row),
            'path' => APP_PATH. implode('/', $row)
        ];
    }

    public function modulePartial($template, $data, $module = null)
    {
        /** @var View $view */
        $view = $this->getDI()->getShared('view');
        $oldPartialsDir = $view->getPartialsDir();
        $partialsDir = '';
        if ($module) {
            $partialsDir = $module. 'views/widgets/';
        }

        $view->setPartialsDir($partialsDir);

        $view->partial($template, $data);

        $view->setPartialsDir($oldPartialsDir);
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

    /**
     * Static method to instantiate a new instance of a class (shorthand of
     * 'instantiate').
     *
     * This method performs exactly the same actions as the 'instantiate'
     * static method, but is simply shorter and easier to type!
     * @return \Lib\Contents\ContentBuilder class
     * @static
     * @throws \ReflectionException
     */
    public function contentBuilder()
    {
        return \Lib\Contents\ContentBuilder::instantiate('test');
    }

    public function partDiv($key)
    {
        $partdiv = (
            strpos($key, 'form') === 0 ||
            strpos($key, 'dt') === 0
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

    /**
     * @return array
     */
    public function getTemplate()
    {
        return $this->content()->getContent()->getParts('template');
    }

    /**
     * @param array $template
     */
    public function setTemplate( $templateName, $translate )
    {
        $this->content()->getContent()->setParts('template', [
            'name' => $templateName,
            'translate' => $translate
        ]);
    }


}