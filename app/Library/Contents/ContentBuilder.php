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

class ContentBuilder extends CB
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->assets = new Asset();
        $this->theme = new Theme($this);
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
                    return $form->getForm();
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
                $this->_fields['form_'. $arg->getPosition()] = $arg->getForm();
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
                $this->_fields['form_'. $arg->getPosition()] = $arg->getForm();
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
                    return $dt->getDT();
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
                $this->_fields['dt_'. $arg->getPosition()] = $arg->getDT();
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
                $this->_fields['dt_'. $arg->getPosition()] = $arg->getDT();
            }
        }

        return $this->_getSet($this->_dataTables, $_, true);
    }

    public function fields()
    {
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

        $this->assets->process();
        $this->view->content = $this->fields();
        $this->view->theme = $this->theme;
        $this->view->messages = $this->flash->getMessages();
    }
}