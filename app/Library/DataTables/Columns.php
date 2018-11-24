<?php
/**
 * Summary File Columns
 *
 * Description File Columns
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 11:59 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Columns extends Component
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;

    protected $_name;

    protected $_data;

    protected $_title;

    protected $_label;

    protected $_visible = true;

    protected $_attributes = [];

    public function __construct($name, $attributes = null, DataTable $dataTable)
    {
        $this->_dataTable = $dataTable;
        $this->setName($name);
        $this->_data = $name;
        $this->setLabel($name);
        $this->setAttributes($attributes);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName( $name ): void
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    public function getAttribute(string $attribute)
    {
        if(isset($this->_attributes[$attribute]))
            return $this->_attributes[$attribute];
        return null;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes( $attributes ): void
    {
        $this->_attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel( $label ): void
    {
        $this->_label = $label;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->_visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible( bool $visible ): void
    {
        $this->_visible = $visible;
    }

    public function add()
    {
        $this->_dataTable->isCustom(false);

        $column = [
            'title' => $this->getLabel(),
            'data'  => $this->_data,
//            'name'  => $this->getName()
        ];

        $column['visible'] = $this->isVisible();

        if(
            array_search($this->_data, $this->_dataTable->data->getDataKeys()) === 0 ||
            is_numeric(array_search($this->_data, $this->_dataTable->data->getDataKeys()))
        )
        {
            $column['target'] = array_search($this->_data, $this->_dataTable->data->getDataKeys()) + 1;

            array_push($this->_dataTable->options['columns'], $column);
        }
    }
}