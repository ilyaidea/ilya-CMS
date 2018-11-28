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

class Columns
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;

    private $columns = [];

    public function __construct($dataTable)
    {
        $this->_dataTable = $dataTable;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addColumn($col)
    {
        $this->columns[] = $col;
    }

    public function addFirstColumn($col)
    {
        array_unshift($this->columns, $col);
    }
}