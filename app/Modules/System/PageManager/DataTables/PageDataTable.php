<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 12/31/2018
 * Time: 3:21 AM
 */
namespace Modules\System\PageManager\DataTables;


use Lib\DataTables\Ajax;
use Lib\DataTables\DataTable;
use Modules\System\PageManager\Models\Pages\ModelPages;

class PageDataTable extends DataTable
{
    public function init()
    {
//        dump( ModelPages::find()->toArray());
        $this->ajax->setType(Ajax:: POST_DATA);
        $this->setTreeView('true');
        $this->setTitle('Page DataTable');

        if($this->isAjax())
        {
            $this->data->setData(
                ModelPages::find(
                    [
                        'conditions' => 'language = :language:',
                        'bind' => [
                            'language' => $this->helper->locale()->getLanguage()
                        ]
                    ]
                )->toArray()
            );
        }


        $parent = $this->column('parent_id');
//        $parent->setVisible(false);
        $parent->setLabel('Parent');

        $title = $this->column('title');
        $title->setLabel('Title');

        $content = $this->column('content');
        $content->setLabel('Content');

        $language = $this->column('language');
        $language->setLabel('Language');

        $position = $this->column('position');
        $position->setLabel('Position');

        $created_at = $this->column('created_at');
        $created_at->setLabel('Created_At');

        $modified_in = $this->column('modified_in');
        $modified_in->setLabel('Modified_In');


        $this->add($parent);
        $this->add($title);
        $this->add($content);
        $this->add($language);
        $this->add($position);
        $this->add($created_at);
        $this->add($modified_in);


        // Add Botton
        $btn_add = $this->button('add');
        $btn_add->setText('Add')->type()->create();
        $this->add($btn_add);

        // Edit Botton
        $btn_edit = $this->button('edit');
        $btn_edit->setText('Edit')->type()->edit()->setEnabled(false);
        $this->add($btn_edit);

        // Delete Botton
        $btn_delete = $this->button('delete');
        $btn_delete->setText('Delete')->type()->remove()->setEnabled(false);
        $this->add($btn_delete);

    }
}