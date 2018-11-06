<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/31/2018
 * Time: 10:26 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Contents\Classes;

use Lib\Contents\CB;
use Lib\Forms\Element\Hidden;
use Phalcon\Text;
use Phalcon\Validation\Validator\Identical;

class Form extends CB
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

    /**
     * Form instance constructor.
     * @param \Lib\Forms\Form $form An instance of the Form class.
     * @param string $name Name to use for Form
     * @param |null $position
     */
    function __construct( \Lib\Forms\Form $form = null, $name = null, $position = null)
    {
        if( $form !== null && $name === null )
        {
            // Allow just a single parameter to be passed - each can be
            // overridden if needed later using the API.
            $this->name( get_class( $form ) );
            $this->getSetForm( $form );
        }
        else
        {
            $this->name( $name );
            $this->getSetForm( $form );
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private parameters
	 */

    /** @var \Lib\Forms\Form */
    private $_form = null;

    /** @var string */
    private $_name = null;

    /** @var string */
    private $_key;
    private $_position;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * static parameters
	 */

    private static $formKey = 'form';

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    public function getSetForm( $_ = null )
    {
        if ( $_ === null ) {
            return $this->_form;
        }

        if( isset( $_ ) && ( $_ instanceof \Lib\Forms\Form ) )
        {
            $this->_form = $_;

            $this->setKey();
            $this->setPosition();
        }

        return $this;
    }

    /**
     * Set the form.
     *
     * @param \Lib\Forms\Form $_ Form value to set.
     * @return self
     */
    public function setForm( $_ = null )
    {
        if( isset( $_ ) && ( $_ instanceof \Lib\Forms\Form ) )
        {
            $this->_form = $_;

            $this->setKey();
            $this->setPosition();
        }

        return $this;
    }

    /**
     * Get the form.
     *
     * @return \Lib\Forms\Form|null
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * Get / set the 'name' property of the form.
     * @param string $_ Value to set if using as a setter.
     * @return string|self The name property if no parameter is given, or self
     *    if used as a setter.
     */
    public function name( $_ = null )
    {
        return $this->_getSet( $this->_name, $_ );
    }

    public function getKey()
    {
        return $this->_getSet( $this->_key, null );
    }

    private function setKey()
    {
        self::$formKey = Text::increment(self::$formKey);
        $this->_form->prefix = self::$formKey;
        $this->_form->initialize();
        return $this->_getSet( $this->_key, self::$formKey );
    }

    private function setPosition()
    {
        self::$position = self::$position + 1;
        return $this->_getSet( $this->_position, self::$position );
    }

    public function getPosition()
    {
        return $this->_position;
    }
}