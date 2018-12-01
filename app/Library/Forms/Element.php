<?php
/**
 * Summary File Element
 *
 * Description File Element
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/1/2018
 * Time: 8:27 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


class Element extends \Phalcon\Forms\Element
{
    /** @var string $_type */
    protected $_type;
    /** @var Design $design */
    public $design;

    public function __construct( $name, array $attributes = null )
    {
        parent::__construct( $name, $attributes );
        $this->design = new Design($this);
    }

    /**
     * Renders the element widget
     *
     * @param array $attributes
     * @return string
     */
    public function render( $attributes = null )
    {
        // TODO: Implement render() method.
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    public function getAttributes()
    {
        $arg = null;
        if(!empty(func_get_args()) && count(func_get_args()) == 1)
        {
            $arg = func_get_args()[0];
        }

        $attrs = parent::getAttributes();

        $attrs = array_merge(
            [
                'type' => $this->_type
            ],
            $attrs
        );

        if($arg)
        {
            return (isset($attrs[$arg])) ? $attrs[$arg] : null;
        }

        return $attrs;
    }
}