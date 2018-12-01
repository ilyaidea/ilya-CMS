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


use Lib\Forms\Element;
use Lib\Tag;

class CheckBoxList extends Element {
    private $_data;
    private $_dataOld;

    public function __construct($name, $data, $dataOld = null, $attribute = null) {
        $this->_data = $data;
        $this->_dataOld = $dataOld;
        parent::__construct($name, $attribute);
        $this->_type = 'select';
    }

    public function render($attribute = null)
    {
        $get_value = $this->getValue();
        if ($get_value) {
            $data = $get_value;
        } else {
            $data = $this->_dataOld;
        }

//        dump($data);
//        dump($this->_data);

        $string = '';
        if ($this->_data) {
            foreach ($this->_data as $key => $value) {
                $arr = ['id' => $this->_name . '-' . $key, 'name' => $this->_name . '[]', 'value' => $key];

                if (in_array($data, array_keys($this->_data))) {
                    echo "1";
                    $arr['checked'] = 'checked';
                }

                $string .= '<label>' . Tag::checkField($arr) . ' ' . $value . '</label>';
            }
        }

        if (isset($this->_attributes['class']))
            return '<div class="' . $this->_attributes['class'] . '">' . $string . '</div>';
        return $string;
    }
}