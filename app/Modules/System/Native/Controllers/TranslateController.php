<?php

namespace Modules\System\Native\Controllers;

use Lib\Assets\Exception;
use Lib\Common\Arrays;
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
        $this->content->theme->noLeftRightMasterPage();
        try {
            $this->content->dataTable(
                DataTable::inst(new DtTranslates(), 'dtTranslate')
            );
            $this->content->dataTable('dtTranslate');
        } catch (\Exception $exception) {
            $this->flash->error($exception->getMessage());
        }
    }

    public function addAction()
    {
        $this->content->theme->noLeftRightMasterPage();
        $fragment = $this->request->get('fragment');
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

                    if (!$translate->save()) {

                        foreach ($translate->getMessages() as $message)
                            $this->flash->error($language['iso'] . ' => ' . $message, $addform);
                    } else {
                        $this->flash->success('Saved for => ' . $language['iso'], $fragment);
                    }

                }//end of foreach

                $this->response->redirect(
                    $this->url->get(
                        [
                            'for' => 'default__' . $this->helper->locale()->getLanguage(),
                            'module' => $this->config->module->name,
                            'controller' => 'translate',
                            'action' => 'index',

                        ]),
                    true
                );
                $this->response->send();

            }//end of if is valid

        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());

        }
    }

    public function editAction()
    {
        $fragment = $this->request->get('fragment');
        $translateId = $this->dispatcher->getParam(0);
        $this->content->theme->noLeftMasterPage();
        try
        {
            if (!$translateId || !is_numeric($translateId))
                throw new \Exception('this translateID does not exist');

            $translateModel = ModelTranslate::findFirst
            ([
                "id = :id: AND language = :lang:",
                'bind' =>
                [
                    'id' => $translateId,
                    'lang' => $this->helper->locale()->getLanguage()
                ]
            ]);
            if (!$translateModel)
                throw new \Exception('this translate does not exist');

            /** @var ModelTranslate $translateModel */
            $oldphrase = $translateModel->getPhrase();

            $this->content->form
            (
                Form::inst(new FormTranslate($translateModel, ['edit' => true]), 'edit_form')
            );
            $edit_form = $this->content->form('edit_form');

            if ($edit_form->isValid())
            {
                if ($oldphrase !== $this->request->getPost('phrase'))
                {
                    $oldphrases = ModelTranslate::findByPhrase($oldphrase);

                    foreach ($oldphrases as $old)
                    {
                        /** @var ModelTranslate $old */
                        $old->setPhrase($this->request->getPost('phrase'));
                        $old->update();
                    }
                }
                else
                {
                    /** @var ModelTranslate $translateModel */
                    $translateModel->setPhrase($this->request->getPost('phrase'));
                    $translateModel->setTranslation($this->request->getPost('translation'));

                    if (!$translateModel->update())
                        $this->flash->error($translateModel->getMessages(), $edit_form->prefix);

                    else
                    {
                        $this->flash->success('success edited', $fragment);
                    }
                    $this->response->redirect(
                        $this->url->get(
                            [
                                'for' => 'default__' . $this->helper->locale()->getLanguage(),
                                'module' => $this->config->module->name,
                                'controller' => 'translate',
                                'action' => 'index',

                            ]),
                        true
                    );
                    $this->response->send();
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
                        throw new \Exception($message->getMessage());
                }
                $this->flash->success('deleted successfully =>' . $translateModel->getPhrase(), $fragment);

            }


        } catch (\Exception $e) {
            $this->flash->error($e->getMessage(), $fragment);

        }
        $this->response->redirect(
            $this->url->get(
                [
                    'for' => 'default__' . $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => 'translate',
                    'action' => 'index',

                ]),
            true
        );
        $this->response->send();
    }

    /**
     * compare translate cache and translate database then
     * insert different array to database
     */
    public function compareAction()
    {
        $translateCache = CmsCache::getInstance()->get('translates');
        $translateModel = ModelTranslate::buildCmsTranslatesCache() ;
        $differentArray = Arrays::compareArrays($translateCache,$translateModel);
        ModelTranslate::insertArrayToDatabase($differentArray);
    }
}

