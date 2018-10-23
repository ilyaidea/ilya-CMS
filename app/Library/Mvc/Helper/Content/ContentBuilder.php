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
use Lib\Mvc\Helper\Content\Parts\Content;
use Lib\Mvc\Helper\Content\Parts\FormTall;
use Lib\Mvc\Helper\Content\Parts\FormWide;
use Lib\Mvc\Helper\Content\Parts\Theme;
use Phalcon\Mvc\User\Component;
use Phalcon\Text;

class ContentBuilder extends Component implements IContentBuilder
{
    /**
     * @var Content
     */
    private static $content;
    private static $formKey = 'form';
    private static $dtKey = 'datatable';

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
        if(self::$content->getParts('template')['name'])
        {
            $like = self::$content->getParts('template')['name'];
        }

        $widgets = ModelWidgets::find([
            'conditions' => "tags = 'all' OR tags LIKE '%".$like."%'",
        ])->toArray();

        if(!self::$content->getParts('template'))
        {
            self::$content->setParts(
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

    public function create()
    {
        self::$instance->widgets();

        self::$content->setParts('theme', self::$theme->result());

        self::$instance->view->content = self::$content->getParts();
    }

    public function getContent()
    {
        return self::$content;
    }
}