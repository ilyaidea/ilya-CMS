<?php
/**
 * Summary File DataTable
 *
 * Description File DataTable
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/18/2018
 * Time: 7:20 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Contents\Classes;


use Lib\Contents\CB;
use Lib\DataTables\DataTablecopy;
use Phalcon\Text;

class DataTable extends CB
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

    /**
     * Form instance constructor.
     * @param \Lib\DataTables\DataTable $dt An instance of the DataTable class.
     * @param string $name Name to use for DataTable
     * @param |null $position
     */
    function __construct( \Lib\DataTables\DataTable $dt = null, $name = null, $position = null)
    {
        if( $dt !== null && $name === null )
        {
            // Allow just a single parameter to be passed - each can be
            // overridden if needed later using the API.
            $this->name( get_class( $dt ) );
            $this->getSetDT( $dt );
        }
        else
        {
            $this->name( $name );
            $this->getSetDT( $dt );
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private parameters
	 */

    /** @var \Lib\DataTables\DataTable */
    private $_dt = null;

    /** @var string */
    private $_name = null;

    /** @var string $_key */
    private $_key;
    /** @var integer $_position */
    private $_position;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * static parameters
	 */

    private static $dtKey = 'dt';

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    /**
     * Summary Function getSetDT
     *
     * Description Function getSetDT
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param null $_
     * @return $this|\Lib\DataTables\DataTable
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function getSetDT( $_ = null )
    {
        if ( $_ === null ) {
            return $this->_dt;
        }

        if( isset( $_ ) && ( $_ instanceof \Lib\DataTables\DataTable ) )
        {
            $this->_dt = $_;

            $this->setKey();
            $this->setPosition();
        }

        return $this;
    }

    /**
     * Set the datatable.
     *
     * @param \Lib\DataTables\DataTable $_ DataTable value to set.
     * @return self
     */
    public function setDT( $_ = null )
    {
        if( isset( $_ ) && ( $_ instanceof \Lib\DataTables\DataTable ) )
        {
            $this->_dt = $_;

            $this->setKey();
            $this->setPosition();
        }

        return $this;
    }

    /**
     * Get the dataTable.
     *
     * @return \Lib\DataTables\DataTable|null
     */
    public function getDT()
    {
        return $this->_dt;
    }

    /**
     * Get / set the 'name' property of the dataTable.
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
        self::$dtKey = Text::increment(self::$dtKey);
        $this->_dt->prefix = self::$dtKey;
        return $this->_getSet( $this->_key, self::$dtKey );
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