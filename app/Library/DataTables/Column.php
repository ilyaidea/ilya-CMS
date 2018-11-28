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

class Column
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;

    private $storage = [];

    public function __construct($name, $attributes = null, $dataTable)
    {
        $this->_dataTable = $dataTable;
        $this->setName($name);
        $this->setData($name);
        $this->setLabel($name);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        if(isset($this->storage['name']))
            return $this->storage['name'];
        return null;
    }

    /**
     * @param mixed $name
     * @return Column
     */
    public function setName( $name )
    {
        $this->storage['name'] = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if(isset($this->storage['data']))
            return $this->storage['data'];
        return null;
    }

    /**
     * @param mixed $data
     * @return Column
     */
    public function setData( $data )
    {
        $this->storage['data'] = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        if(isset($this->storage['title']))
            return $this->storage['title'];
        return null;
    }

    /**
     * @param mixed $label
     */
    public function setLabel( $label )
    {
        $this->storage['title'] = $label;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        if(isset($this->storage['visible']))
            return $this->storage['visible'];
        return true;
    }

    /**
     * @param bool $visible
     * @return Column
     */
    public function setVisible( $visible )
    {
        $this->storage['visible'] = $visible;

        return $this;
    }

    public function add()
    {
        $this->_dataTable->columns->addColumn($this->storage);
    }
}