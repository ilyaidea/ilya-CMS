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


use Lib\Contents\Classes\Form;
use Phalcon\Exception\Db\UnknownColumnTypeException;

class ContentBuilder extends CB
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public properties
	 */

    /** @var string */
    public $version = '1.0.0';

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private properties
	 */

    /** @var Form[]|\Lib\Forms\Form[] */
    private $_forms = [];

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

    public function fields()
    {
        return $this->_fields;
    }

    public function toArray( $print = true )
    {
        $this->view->content = $this->fields();
    }

    /**
     * Process a request from the Editor client-side to get / set data.
     *
     *  @param array $data Typically $_POST or $_GET as required by what is sent
     *  by Editor
     *  @return self
     */
    public function process ( $data )
    {
//        if ( $this->_debug ) {
//            $debugInfo = &$this->_debugInfo;
//            $debugVal = $this->_db->debug( function ( $mess ) use ( &$debugInfo ) {
//                $debugInfo[] = $mess;
//            } );
//        }

        if ( $this->_tryCatch ) {
            try {
                $this->_process( $data );
            }
            catch (\Exception $e) {
                // Error feedback
                $this->_out['error'] = $e->getMessage();

                if ( $this->_transaction ) {
                    $this->_db->rollback();
                }
            }
        }
        else {
            $this->_process( $data );
        }

        if ( $this->_debug ) {
            $this->_out['debug'] = $this->_debugInfo;

            // Save to a log file
            if ( $this->_debugLog ) {
                file_put_contents( $this->_debugLog, json_encode( $this->_debugInfo )."\n", FILE_APPEND );
            }

            $this->_db->debug( false );
        }

        return $this;
    }
}