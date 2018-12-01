<?php
/**
 * Summary File RadioGroup
 *
 * Description File RadioGroup
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/1/2018
 * Time: 8:24 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms\Element;


class RadioGroup extends Select
{
    private $checked = null;

    public function __construct( $name, $options = null, $attributes = null )
    {
        parent::__construct( $name, $options, $attributes );
        $this->_type = 'radiogroup';
    }

    public function render( $attributes = null )
    {
        if(!empty($attributes))
        {
            foreach($attributes as $key => $value)
            {
                $this->setAttribute($key, $value);
            }
        }

        $attr = $this->getAttributes();
        $rendered = isset($attr['label']) ? '<h3>'. $attr['label']. '</h3>' : '';
        $cssClass = isset($attr['class']) ? ' class="'. $attr['class']. '"' : '';

        $eleName = $this->getName(). '_';

        foreach($this->getOptions() as $key => $label)
        {
            $checked = '';
            if($key == $this->getValue())
            {
                $checked = ' checked="true"';
            }

            $rendered .= '<label for="'. $eleName. $key. '"'. $cssClass.
            '><input type="radio"'. $checked. ' id="'.$eleName. $key.
            '" name="'. $this->getName(). '" value="'. $key. '"> '.
            $label. '</label>';
        }

        return $rendered;
    }

    /**
     * @return null
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param null $checked
     */
    public function setChecked( $checked )
    {
        $this->checked = $checked;
    }
}