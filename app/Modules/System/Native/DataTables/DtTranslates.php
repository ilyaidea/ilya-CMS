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
use Modules\System\Native\Models\Translate\ModelTranslate;

class DtTranslates extends DataTable
{
    public function init()
    {
        $this->setTitle('Translate DataTable');
        $this->disableError();
        if ($this->isAjax())
        {
            $this->data->setData(
              ModelTranslate::find(
                  [
                      'conditions' => 'language = :language:',
                      'bind' => [
                          'language' => $this->helper->locale()->getLanguage()
                      ]
                  ]
              )->toArray()
            );
        }
        //id
        $id = $this->column('id');
        $id->setLabel('id');
        $this->add($id);

        //language
        $language = $this->column('language');
        $language->setLabel('language');
        $this->add($language);

        //phrase
        $phrase = $this->column('phrase');
        $phrase->setLabel('phrase');
        $this->add($phrase);

        //translation
        $translation = $this->column('translation');
        $translation->setLabel('translation');
        $this->add($translation);

        //btn
        //add
        $btn_add = $this->button('add');
        $btn_add
            ->setText('add')
            ->setEnabled(true)
            ->type()->create();
        $this->add($btn_add);

        //delete
        $btn_delete = $this->button('delete');
        $btn_delete
            ->setText('Delete')
            ->setEnabled(false)
            ->type()->remove();

        $this->add($btn_delete);

        //delete
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