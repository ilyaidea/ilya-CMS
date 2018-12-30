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
use Phalcon\Mvc\Model;

class Select extends Element
{
    protected $_optionsValues = [];

    public function __construct( $name, $options = null, $attributes = null )
    {
        $this->_optionsValues = $options;
        parent::__construct( $name, $attributes );
        $this->_type = 'select';

        if($options instanceof Model\Resultset)
        {
            $this->_optionsValues = [];
            if($attributes['using'] && is_array($attributes['using']))
            {
                $key = $attributes['using'][0];
                $value = $attributes['using'][1];

                if($attributes['useEmpty'])
                {
                    $emptyText = null;
                    $emptyValue = '';
                    if($attributes['emptyText'])
                        $emptyText = $attributes['emptyText'];
                    if($attributes['emptyValue'])
                        $emptyValue = $attributes['emptyValue'];
                    $this->_optionsValues[$emptyValue] = $emptyText;
                }

                $this->_optionsValues = array_merge($this->_optionsValues, array_column($options->toArray(), $key, $value));
            }
        }
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