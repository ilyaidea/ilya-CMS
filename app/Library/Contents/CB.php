<?php
/**
 * Summary File CB
 *
 * Description File CB
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/31/2018
 * Time: 9:52 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Contents;


use Lib\Contents\Classes\Form;
use Phalcon\Mvc\User\Component;

/**
 * Base class for ContentBuilder classes.
 */
class CB extends Component
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private And Static properties
	 */

    /** @var ContentBuilder */
    protected static $instance;

    protected static $oldArgs = [];

    /**
     * Static method to instantiate a new instance of a class (shorthand of
     * 'instantiate').
     *
     * This method performs exactly the same actions as the 'instantiate'
     * static method, but is simply shorter and easier to type!
     * @return ContentBuilder class
     * @static
     * @throws \ReflectionException
     */
    public static function instantiate()
    {
        $args = func_get_args();

        if(!self::$instance || self::$oldArgs != $args)
        {
            $rc = new \ReflectionClass( get_called_class() );

            self::$oldArgs = $args;

            if( count( $args ) === 0)
                self::$instance = $rc->newInstance();
            else
                self::$instance = $rc->newInstanceArgs( $args );
        }

        return self::$instance;
    }

    /**
     * Static method to instantiate a new instance of a class (shorthand of
     * 'instantiate').
     *
     * This method performs exactly the same actions as the 'instantiate'
     * static method, but is simply shorter and easier to type!
     * @return Form|ContentBuilder|object
     *  @static
     * @throws \ReflectionException
     */
    public static function inst ()
    {
        $rc = new \ReflectionClass( get_called_class() );
        $args = func_get_args();

        return count( $args ) === 0 ?
            $rc->newInstance() :
            $rc->newInstanceArgs( $args );
    }

    /**
     * Common getter / setter function for DataTables classes.
     *
     * This getter / setter method makes building getter / setting methods
     * easier, by abstracting everything to a single function call.
     *  @param mixed &$prop The property to set
     *  @param mixed $val The value to set - if given as null, then we assume
     *    that the function is being used as a getter.
     *  @param boolean $array Treat the target property as an array or not
     *    (default false). If used as an array, then values passed in are added
     *    to the $prop array.
     *  @return self|mixed Class instance if setting (allowing chaining), or
     *    the value requested if getting.
     */
    protected function _getSet( &$prop, $val, $array=false )
    {
        // Get
        if ( $val === null ) {
            return $prop;
        }

        // Set
        if ( $array ) {
            // Property is an array, merge or add to array
            is_array( $val ) ?
                $prop = array_merge( $prop, $val ) :
                $prop[] = $val;
        }
        else {
            // Property is just a value
            $prop = $val;
        }

        return $this;
    }

    public function getHash($class = null, $name = null)
    {
        return $this->security->hash($class.$name);
    }
}