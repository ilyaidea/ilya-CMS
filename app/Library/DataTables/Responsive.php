<?php
/**
 * Summary File Responsive
 *
 * Description File Responsive
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/24/2018
 * Time: 9:44 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Responsive extends Component
{
    /** @var DataTable $_dataTable */
    private $_dataTable;

    public function __construct(DataTable $dataTable)
    {
        $this->_dataTable = $dataTable;
    }

    public function process()
    {
        // responsive datatable
        $this->_dataTable->content->assets->addCss(
            'assets/datatables.net-responsive-dt/css/responsive.dataTables.min.css'
        );
        $this->_dataTable->content->assets->addJs(
            'assets/datatables-responsive/js/dataTables.responsive.js'
        );

        $this->_dataTable->options['responsive']['details']['display'] = "||$.fn.dataTable.Responsive.display.childRowImmediate||";
        $this->_dataTable->options['responsive']['details']['type'] = "";
    }
}