<?php
/**
 * Summary File Languages
 *
 * Description File Languages
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/16/2018
 * Time: 8:20 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Native\DataTables;

use Lib\DataTables\DataTable;
use Modules\System\Native\Models\Language;

class DtLanguages extends DataTable
{
    public function init()
    {
       // $this->query['data'] =Language\ModelLanguage::findAllForDataTable();
        $this->setTitle('Language DataTable');
        $this->disableError();
        if ($this->isAjax())
        {
            $this->data->setData(
                Language\ModelLanguage::find()->toArray()
            );
        }

        //id
        $id = $this->column('id');
        $id->setLabel('id');
        $this->add($id);

        //iso
        $iso = $this->column('iso');
        $iso->setLabel('iso');
        $this->add($iso);

        //title
        $title = $this->column('title');
        $title->setLabel('title');
        $this->add($title);

        //position
        $position = $this->column('position');
        $position->setLabel('position');
        $this->add($position);

        //is_primary
        $is_primary = $this->column('is_primary');
        $is_primary->setLabel('is_primary');
        $this->add($is_primary);

        //direction
        $direction = $this->column('direction');
        $direction->setLabel('direction');
        $this->add($direction);

        //btn
        $btn_add = $this->button('add');
        $btn_add
            ->setText('add')
            ->setEnabled(true)
            ->type()->create();
        $this->add($btn_add);

        $btn_delete = $this->button('delete');
        $btn_delete
            ->setText('Delete')
            ->setEnabled(false)
            ->type()->remove();

        $this->add($btn_delete);

        $btn_edit = $this->button('edit');
        $btn_edit
            ->setText('edit')
            ->setEnabled(true)
            ->type()->edit();

        $this->add($btn_edit);

        //dom
        $this->setDom('Blftipr');
    }

}