<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 12:29 PM
 */

namespace Modules\System\Widgets\DataTables;

use Lib\DataTables\DataTable;
use Modules\System\Widgets\Lib\WidgetDetails;

class WidgetDataTable extends DataTable
{
    public function init()
    {
        $this->setTitle('Widget');

        $this->disableError();

        //set data ajax
        if($this->isAjax())
        {
            $this->data->setData(WidgetDetails::WidgetList());
        }
        $this->addColumns();
    }

    //addColumns
    public function addColumns()
    {
        $name = $this->column('name');
        $name->setLabel('Widget Name');
        $this->add($name);

        $description = $this->column('description');
        $description->setLabel('Widget Description');
        $this->add($description);

        $author = $this->column('author');
        $author->setLabel('Widget Author');
        $this->add($author);

        $version = $this->column('version');
        $version->setLabel('Widget Version');
        $this->add($version);
    }



}