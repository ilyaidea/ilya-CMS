<?php
/**
 * Summary File Text
 *
 * Description File Text
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/8/2018
 * Time: 9:40 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms\Element;

use Lib\Forms\Element;

class Select extends Element
{
    protected $_optionsValues;

    public function __construct( $name, $options = null, $attributes = null )
    {
        $this->_optionsValues = $options;
        parent::__construct( $name, $options, $attributes );
        $this->_type = 'select';
    }

    public function render( $attributes = null )
    {
        /**
         * Merged passed attributes with previously defined ones
         */

        return \Phalcon\Tag\Select::selectField($this->prepareAttributes($attributes), $this->_optionsValues);
    }

    public function setOptions($options)
    {
        $this->_optionsValues = $options;
        return $this;
    }

    public function getOptions()
    {
        return $this->_optionsValues;
    }

    /**
     * Adds an option to the current options
     *
     * @param array $option
     * @return $this
     */
    public function addOption($option)
    {
        if(is_array($option))
        {
            foreach($option as $key=>$value)
            {
                $this->_optionsValues[$key] = $value;
            }
        }
        else
        {
            $this->_optionsValues[] = $option;
        }

        return $this;
    }
}