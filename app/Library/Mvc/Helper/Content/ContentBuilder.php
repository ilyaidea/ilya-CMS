<?php
/**
 * Summary File ContentBuilder
 *
 * Description File ContentBuilder
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 3:56 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper\Content;


use Ilya\Models\ModelWidgets;
use Lib\Assets\Filters\Cssmin;
use Lib\Assets\Filters\Jsmin;
use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Helper\Content\Parts\Content;
use Lib\Mvc\Helper\Content\Parts\FormTall;
use Lib\Mvc\Helper\Content\Parts\FormWide;
use Lib\Mvc\Helper\Content\Parts\Theme;
use Lib\Assets\Minify\CSS;
use Lib\Assets\Minify\JS;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\User\Component;
use Phalcon\Text;

/**
 * @property CSS cssmin
 * @property JS jsmin
 */
class ContentBuilder extends Component implements IContentBuilder
{
    /**
     * @var Content
     */
    private static $content;
    private static $formKey = 'form';
    private static $dtKey = 'datatable';
    private static $template;

    /**
     * @var Theme
     */
    private static $theme;

    /**
     * @var ContentBuilder
     */
    private static $instance;

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$content = new Content();
            self::$theme = Theme::getInstance();
            self::$instance = new ContentBuilder();
            self::$content->setParts('key', self::$instance->getHashKey());
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getDtKey()
    {
        return self::$dtKey;
    }

    /**
     * @param string $dtKey
     */
    public function setDtKey()
    {
        self::$dtKey = Text::increment(self::$dtKey);
    }

    public function addFormWide( \Lib\Forms\Form $form )
    {
        self::$formKey = Text::increment(self::$formKey);

        $form = new FormWide($form, self::$formKey);
        self::$content->setParts(self::$formKey, $form->toArray());
        return $form;
    }

    public function addFormTall( \Lib\Forms\Form $form )
    {
        self::$formKey = Text::increment(self::$formKey);

        $form = new FormTall($form, self::$formKey);
        self::$content->setParts(self::$formKey, $form->toArray());
        return $form;
    }

    public function addDataTable( \Lib\DataTables\DataTable $dataTable )
    {
//        self::$dtKey = Text::increment(self::$dtKey);

        self::$content->setParts(self::$instance->getDtKey(), $dataTable->toArray());
        return $dataTable;
    }

    public function widgets()
    {
        $like = null;
        if(isset(self::$content->getParts('template')['name']))
        {
            $like = self::$content->getParts('template')['name'];
        }

        $widgets = ModelWidgets::find([
            'conditions' => "tags = 'all' OR tags LIKE '%".$like."%'",
        ])->toArray();

        if(!isset(self::$content->getParts('template')['name']))
        {
            return self::$content->setParts(
                'widgets',
                $widgets
            );
        }

        $templateName = self::$content->getParts('template')['name'];

        $regioncodes = array(
            'F' => 'full',
            'M' => 'main',
            'S' => 'side1',
            'N' => 'side2',
        );

        $placecodes = array(
            'T' => 'top',
            'H' => 'high',
            'L' => 'low',
            'B' => 'bottom',
        );

        $widgets_content = [];
        foreach($widgets as $widget)
        {
            $tagstring = ',' . $widget['tags'] . ',';
            $showOnTmpl = strpos($tagstring, ",$templateName,") !== false || strpos($tagstring, ',all,') !== false;
            // special case for user pages
            $showOnUser = strpos($tagstring, ',user,') !== false && preg_match('/^user(-.+)?$/', $templateName) === 1;

            if ($showOnTmpl || $showOnUser) {
                // widget has been selected for display on this template
                $region = @$regioncodes[substr($widget['place'], 0, 1)];
                $place = @$placecodes[substr($widget['place'], 1, 2)];

                if (isset($region) && isset($place)) {
                    // region/place codes recognized
                    $module = $widget['namespace'];
                    $allowTmpl = (substr($templateName, 0, 7) == 'custom-') ? 'custom' : $templateName;

                    if (isset($module)/* &&
                        method_exists($module, 'allow_template') && $module->allow_template($allowTmpl) &&
                        method_exists($module, 'allow_region') && $module->allow_region($region) &&
                        method_exists($module, 'output_widget')*/
                    ) {
                        // if module loaded and happy to be displayed here, tell theme about it
                        $widgets_content[$region][$place][] = $module;
                    }
                }
            }
        }

        self::$content->setParts(
            'widgets',
            $widgets_content
        );
    }

    public function getTheme()
    {
        return self::$theme;
    }

    public function setTemplate($name, $label)
    {
        self::$content->setParts('template', [
            'name' => $name,
            'label' => $label
        ]);
    }

    public function create()
    {
        self::$instance->widgets();

        self::$content->setParts('theme', self::$theme->result());

        self::$instance->createAssets();

        self::$instance->view->content = self::$content->getParts();
    }

    public function getContent()
    {
        return self::$content;
    }

    public function createAssets()
    {
        $key = self::$content->getParts('key');

        $cssSize = 0;
        if(self::$content->getParts('css'))
        {
            foreach(self::$content->getParts('css') as $css )
            {
                if (filter_var($css, FILTER_VALIDATE_URL) == true) {
                    self::$instance->assets->addCss($css, false);
                    continue;
                }
                if(!file_exists($css))
                {
                    $cssSize += strlen($css);
                }
                else
                {
                    $cssSize += filesize($css);
                }

                self::$instance->cssmin->add($css);
            }
        }

        if($cssSize !== CmsCache::getInstance()->get($key. '.css'))
        {
            self::$instance->cssmin->minify('tmp/'. $key.'.css');
            CmsCache::getInstance()->save($key.'.css', $cssSize);
        }

        $jsSize = 0;
        if(self::$content->getParts('js'))
        {
            foreach(self::$content->getParts('js') as $js )
            {
                if (filter_var($js, FILTER_VALIDATE_URL) == true) {
                    self::$instance->assets->addJs($js, false);
                    continue;
                }
                if(!file_exists($js))
                {
                    $jsSize += strlen($js);
                }
                else
                {
                    $jsSize += filesize($js);
                }

                self::$instance->jsmin->add($js);
            }
        }

        if($jsSize !== CmsCache::getInstance()->get($key. '.js'))
        {
            self::$instance->jsmin->minify('tmp/'. $key.'.js');
            CmsCache::getInstance()->save($key.'.js', $jsSize);
        }

        self::$instance->assets->addCss('tmp/'. $key.'.css');
        self::$instance->assets->addJs('tmp/'. $key.'.js');
    }

    protected function getHashKey()
    {
        return
            HOST_HASH.
            self::$instance->dispatcher->getParam('lang').
            md5(
                self::$instance->dispatcher->getControllerClass().
                '\\'.
                self::$instance->dispatcher->getActionName());
    }
}