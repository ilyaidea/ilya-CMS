<?php

namespace Modules\System\Native\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Lib\Mvc\Helper\CmsCache;
use Modules\System\Native\DataTables\DtTranslates;
use Modules\System\Native\Forms\FormTranslate;
use \Modules\System\Native\Models\Translate\ModelTranslate;

/**
 * @property Helper $helper
 */
class TranslateController extends Controller
{
    public function indexAction()
    {
        try {
            $this->content->theme->noLeftRightMasterPage();
            //$content->setTemplate('translate-list', 'ModelTranslate List');
            $this->content->dataTable(
                DataTable::inst(new DtTranslates(), 'dtTranslate')
            );
            $this->content->dataTable('dtTranslate');
            $this->content->process();
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Summary Function addAction
     *
     * Description Function addAction
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function addAction()
    {
        try {
            $this->content->form(
                Form::inst(new FormTranslate(), 'add_form')
            );
            $addform = $this->content->form('add_form');
            if ($addform->isValid()) {
                foreach (CmsCache::getInstance()->get('languages') as $language) {
                    $translateIsAlreadyExisted = ModelTranslate::findFirst([
                        'conditions' => 'phrase = :phrase: AND language = :lang:',
                        'bind' => [
                            'phrase' => $this->request->getPost('phrase'),
                            'lang' => $language['iso']
                        ]
                    ]);
                    if ($translateIsAlreadyExisted)
                        continue;
                    $translate = new ModelTranslate();
                    $translate->setPhrase($this->request->getPost('phrase'));
                    $translate->setTranslation(null);
                    if ($language['iso'] == $this->helper->locale()->getLanguage())
                        $translate->setTranslation($this->request->getPost('translation'));

                    $translate->setLanguage($language['iso']);

                    if (!$translate->create()) {
                        foreach ($translate->getMessages() as $message)
                            $this->flash->error($language['iso'] . ' => ' . $message);
                    } else {
                        $this->flash->success("Saved for => " . $language['iso']);
                    }
                }//end of foreach

            }//end of if is valid


        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());

        }
    }

    public function editAction()
    {
        $this->content->theme->noLeftRightMasterPage();
        try {
            $translateId = $this->dispatcher->getParam(0);
            if (!$translateId || !is_numeric($translateId))
                throw new \Exception('this translateID does not exist');

            $translateModel = ModelTranslate::findFirst([
                "id = :id: AND language = :lang:",
                'bind' => [
                    'id' => $translateId,
                    'lang' => $this->helper->locale()->getLanguage()
                ]
            ]);
            if (!$translateModel)
                throw new \Exception('this translate does not exist');

            /** @var ModelTranslate $translateModel */
            $oldphrase = $translateModel->getPhrase();

            $this->content->form(
                Form::inst(new FormTranslate($translateModel, ['edit' => true]), 'edit_form')

            );
            $edit_form = $this->content->form('edit_form');

            if ($edit_form->isValid()) {
                if ($oldphrase !== $this->request->getPost('phrase')) {
                    $oldphrases = ModelTranslate::findByPhrase($oldphrase);

                    foreach ($oldphrases as $old) {
                        /** @var ModelTranslate $old */
                        $old->setPhrase($this->request->getPost('phrase'));
                        $old->update();
                    }
                } else {
                    /** @var ModelTranslate $translateModel */
                    $translateModel->setPhrase($this->request->getPost('phrase'));
                    $translateModel->setTranslation($this->request->getPost('translation'));
                    if (!$translateModel->update())
                        $this->flash->error($translateModel->getMessages());
                    $this->flash->success('success edit');
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());

        }

    }

    public function deleteAction()
    {
        $fragment = $this->request->get('fragment');
        $translateId = $this->dispatcher->getParam(0);

        try {
            if (!$translateId || !is_numeric($translateId))
                throw new \Exception('this languageId is not valid');
            if (!$fragment)
                throw new \Exception('this fragment is not valid');

            /** @var ModelTranslate $translateModel */
            $translateModel = ModelTranslate::findFirst([
                'conditions' => 'id = :id:',
                'bind' => [
                    'id' => $translateId
                ]
            ]);

            if (!$translateModel)
                throw new \Exception('this phrase does not exist');

            else {
                /** @var ModelTranslate $translates */
                $translates = ModelTranslate::findByPhrase($translateModel->getPhrase());

                if (!$translates->delete()) {
                    foreach ($translates->getMessages() as $message)
                        throw new \Exception($message);
                }
                $this->flash->success('deleted successfully', $fragment);

            }


        } catch (\Exception $e) {
            $this->flash->error($e->getMessage(), $fragment);

        }
    }
}