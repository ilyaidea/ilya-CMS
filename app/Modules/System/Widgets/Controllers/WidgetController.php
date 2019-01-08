<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 12:26 PM
 */

namespace Modules\System\Widgets\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Modules\System\Widgets\DataTables\WidgetDataTable;
use Modules\System\Widgets\Forms\WidgetForm;

class WidgetController extends Controller
{
    public function showAction()
    {
            $this->content->theme->noLeftRightMasterPage();

            $this->content->dataTable(
                DataTable::inst(new WidgetDataTable(), 'dt_widget')
            );

            $this->content->dataTable('dt_widget');

    }
    public function addAction()
    {
        $this->content->theme->noLeftRightMasterPage();

        $this->content->form(
            Form::inst(new WidgetForm(),'add_form')
        );

        $addForm = $this->content->form('add_form');

    }

}