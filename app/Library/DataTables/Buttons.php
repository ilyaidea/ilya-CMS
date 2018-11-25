<?php
/**
 * Summary File Buttons
 *
 * Description File Buttons
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 5:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class Buttons extends Component
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
    }

    public function add()
    {
        $this->_dataTable->isCustom(false);
    }

    /**
     * @return DataTable
     */
    public function getDataTable(): DataTable
    {
        return $this->_dataTable;
    }

    /**
     * @param DataTable $dataTable
     */
    public function setDataTable( DataTable $dataTable ): void
    {
        $this->_dataTable = $dataTable;
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
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param mixed $data
     */
    public function setData( $data ): void
    {
        $this->_data = $data;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle( $title ): void
    {
        $this->_title = $title;
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

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->_attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes( array $attributes ): void
    {
        $this->_attributes = $attributes;
    }
}