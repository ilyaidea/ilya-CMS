<?php
/**
 * Summary File Select
 *
 * Description File Select
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 6:51 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;

class Select
{
    /** @var DataTable $_dataTable */
    private $_dataTable;

    public function __construct(DataTable $dataTable)
    {
        $this->_dataTable = $dataTable;
        $this->_dataTable->options['select'] = true;
    }

    public function process()
    {
        if(isset($this->_dataTable->options['select']))
        {
            $this->_dataTable->addCss(
                'assets/datatables.net-select-dt/css/select.dataTables.min.css',
                false
            );
            $this->_dataTable->addJs(
                'assets/datatables.net-select/js/dataTables.select.min.js',
                false
            );
        }
    }

}