<?php
/**
 * Summary File ContentBuilder
 *
 * Description File ContentBuilder
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/31/2018
 * Time: 9:35 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Contents;


use Lib\Assets\Asset;
use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Contents\Classes\Theme;
use Lib\Mvc\Model\Options\ModelOptions;
use Lib\Mvc\Model\Widgets\ModelWidgets;
use Lib\Tag;

class ContentBuilder extends CB
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->assets = new Asset();
        $this->theme = new Theme($this);

        Tag::appendHtmlTag('lang', $this->helper->locale()->getLanguage());
        Tag::setTitle(ModelOptions::findCacheByKey('site_title'));
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public properties
	 */

    /** @var string */
    public $version = '1.0.0';

    /** @var Asset $assets */
    public $assets;

    /** @var Theme $theme */
    public $theme;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private properties
	 */

    /** @var Form[]|\Lib\Forms\Form[] */
    private $_forms = [];

    /** @var DataTable[]|\Lib\DataTables\DataTable[] */
    private $_dataTables = [];

    private $_fields = [];

    /** @var array */
    private $_out = [];

    private $_template = null;


    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    /**
     * Get / set Form instance.
     *
     * The list of fields designates which columns in the table that Editor will work
     * with (both get and set).
     * @param Form|string $_ ... This parameter effects the return value of the
     *      function:
     *
     *      * `null` - Get an array of all fields assigned to the instance
     *        * `string` - Get a specific form instance whose 'name' matches the
     *           field passed in
     *        of fields.
     * @return \Lib\Forms\Form
     *      the Editor instance for chaining, depending on the input parameter.
     * @throws \Exception UnknownColumnTypeException form error
     */
    public function form( $_ = null )
    {
        if( is_string( $_ ) )
        {
            foreach( $this->_forms as $form )
            {
                if( $form->name() === $_ )
                {
                    return $form->get();
                }
            }

            throw new \Exception( 'Unknown form: '.$_ );
        }

        if( $_ !== null && !is_array( $_ ) && $_ instanceof Form)
        {
            $_ = func_get_args();
            /** @var Form $arg */
            foreach($_ as $arg)
            {
                $this->_fields['form_'. $arg->getPosition()] = $arg;
            }
        }

        return $this->_getSet($this->_forms, $_, true);
    }

    public function forms( $_ = null )
    {
        if( $_ !== null && !is_array( $_ ) && $_ instanceof Form)
        {
            $_ = func_get_args();
            /** @var Form $arg */
            foreach($_ as $arg)
            {
                $this->_fields['form_'. $arg->getPosition()] = $arg;
            }
        }

        return $this->_getSet($this->_forms, $_, true);
    }

    /**
     * Get / set dataTable instance.
     *
     * The list of fields designates which columns in the table that Editor will work
     * with (both get and set).
     * @param DataTable|string $_ ... This parameter effects the return value of the
     *      function:
     *
     *      * `null` - Get an array of all fields assigned to the instance
     *        * `string` - Get a specific form instance whose 'name' matches the
     *           field passed in
     *        of fields.
     * @return \Lib\DataTables\DataTable
     *      the Editor instance for chaining, depending on the input parameter.
     * @throws \Exception UnknownColumnTypeException form error
     */
    public function dataTable( $_ = null )
    {
        if( is_string( $_ ) )
        {
            foreach( $this->_dataTables as $dt )
            {
                if( $dt->name() === $_ )
                {
                    return $dt->get();
                }
            }

            throw new \Exception( 'Unknown form: '.$_ );
        }


        if( $_ !== null && !is_array( $_ ) && $_ instanceof DataTable)
        {
            $_ = func_get_args();
            /** @var DataTable $arg */
            foreach($_ as $arg)
            {
                $this->_fields['dt_'. $arg->getPosition()] = $arg;
            }
        }

        return $this->_getSet($this->_dataTables, $_, true);
    }

    public function dataTables( $_ = null )
    {
        if( $_ !== null && !is_array( $_ ) && $_ instanceof DataTable)
        {
            $_ = func_get_args();
            /** @var DataTable $arg */
            foreach($_ as $arg)
            {
                $this->_fields['dt_'. $arg->getPosition()] = $arg;
            }
        }

        return $this->_getSet($this->_dataTables, $_, true);
    }

    public function fields($filter = false)
    {
        if($filter)
        {
            $fields = [];
            foreach($this->_fields as $key=>$field)
            {
                $fields[$key] = $field->get();
            }
            return $fields;
        }
        return $this->_fields;
    }

    /**
     * Process a request from the Editor client-side to get / set data.
     */
    public function process ()
    {
        if(!empty($this->fields()))
        {
            foreach($this->fields() as $field)
            {
                $field->process();
            }
        }

        // scroll to content
        $this->assets->addJs( /** @lang JavaScript */
            "
$( document ).ready(function() {
    function goToByScroll(id){
        $('html,body').animate({scrollTop: $(id).offset().top},'slow');
    }
    var hash = window.location.hash;
    setTimeout(function(){
        goToByScroll(hash);
    },500);
});
");

        $this->assets->process();
        $this->view->content = $this->fields(true);
        $this->view->theme = $this->theme;
        $this->view->widgets = $this->getWidgets();
        $this->view->messages = $this->flash->getMessages();
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->_template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate( $template )
    {
        $this->_template = $template;
    }

    public function getWidgets()
    {
        $like = null;
        if($this->getTemplate())
        {
            $like = $this->getTemplate();
        }

        $widgets = ModelWidgets::find([
            'conditions' => "tags = 'all' OR tags LIKE '%".$like."%' OR tags LIKE '%".$like."%'",
        ])->toArray();

        if(!$this->getTemplate())
        {
            return null;
        }

        $templateName = $this->getTemplate();

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

        return $widgets_content;
    }
}