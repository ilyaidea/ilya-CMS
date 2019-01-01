<?php

namespace Modules\System\Native\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Modules\System\Native\DataTables\Languages;
use Modules\System\Native\DataTables\DtLanguages;
use Modules\System\Native\Forms\FormLanguage;
use Modules\System\Native\Models\Language;

/**
 * @property Helper $helper
 */
class LanguageController extends Controller
{
    public function indexAction()
    {
        try
        {
            $this->content->theme->noLeftRightMasterPage();

            $this->content->dataTable(
                DataTable::inst(new DtLanguages(), 'dtLang')
            );

            $this->content->dataTable('dtLang');
            $this->content->process();
        }
        catch (\Exception $e)
        {
            dump('ok');
        }
    }

    public function addAction()
    {
        try {

            $this->content->form(
                Form::inst(new FormLanguage(), 'add_form')
            );
            $add_form = $this->content->form('add_form');
            if ($add_form->isValid())
            {
                $language = new Language\ModelLanguage();
                $language->setIso($this->request->getPost('iso'));
                $language->setTitle($this->request->getPost('title'));
                $language->setPosition($this->request->getPost('position'));
                $language->setIsPrimary($this->request->getPost('is_primary'));
                $language->setDirection($this->request->getPost('direction'));


                if (!$language->save()) {

                    foreach ($language->getMessages() as $message)
                        $this->flash->error($message);
                }
                else
                {
                    $this->flash->success('language is added');
                    //redirect to show
                    $this->response->redirect(
                        $this->url->get(
                            [
                                'for' => 'default__'.$this->helper->locale()->getLanguage(),
                                'module' => $this->config->module->name,
                                'controller' => 'language',
                                'action' => 'index',

                            ]),
                        true
                    );
                    return;
                }
            }
        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage());

        }
    }

    public function editAction( )
    {
        $this->content->theme->noLeftRightMasterPage();
        try
        {
            $langId = $this->dispatcher->getParam(0);
            if (!$langId || !is_numeric($langId))
                throw new \Exception('this languageID does not exist');

            /** @var Language\ModelLanguage $language */
            $language = Language\ModelLanguage::findFirst($langId);
            if (!$language)
                throw new \Exception('this language does not exist in database');

            $this->content->form(
                Form::inst(new FormLanguage($language, ['edit' => true]),'edit_form')

            );
            $edit_form = $this->content->form('edit_form');

            if ($edit_form->isValid())
            {
                $language->setTitle(
                    $this->request->getPost('title')
                );
                $language->setIso(
                    $this->request->getPost('iso')
                );
                $language->setPosition(
                    $this->request->getPost('position')
                );
                $language->setIsPrimary(
                    $this->request->getPost('is_primary') ? $this->request->getPost('is_primary') : 0
                );
                $language->setDirection(
                    $this->request->getPost('direction')
                );

                if ($language->update()) {

                    //dump($_POST);
                    $this->flash->success('success',$edit_form->prefix);
                    $this->response->redirect(
                        $this->url->get(
                            [
                                'for' => 'default__'.$this->helper->locale()->getLanguage(),
                                'module' => $this->config->module->name,
                                'controller' => 'Language',
                                'action' => 'index',

                            ]),
                        true
                    );
                    return;
                }
                else
                {
                    foreach ($language->getMessages() as $message)
                        $this->flash->error($message,$edit_form->prefix);
                }
            }
        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage());

        }

    }
    public function deleteAction()
    {
        $fragment = $this->request->get('fragment');
        $langId = $this->dispatcher->getParam(0);

        try
        {
            if (!$langId || !is_numeric($langId))
                throw new \Exception('this languageId is not valid');
            if (!$fragment)
                throw new \Exception('this fragment is not valid');

            /** @var Language\ModelLanguage $language */
            $language = Language\ModelLanguage::findFirstById($langId);

            if (!$language)
                throw new \Exception('this language does not exist');

            if ($language->getIsPrimary() == 1)
                throw new \Exception('oops! cannot delete, this language is primary');

            if (!$language->delete())
            {
                foreach ($language->getMessages() as $message)
                    throw new \Exception($message);
            }
            $this->flash->success('deleted successfully',$fragment);

        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage(),$fragment);


        }
//        $this->response->redirect(
//            $this->url->get(
//                [
//                    'for' => 'default__'.$this->helper->locale()->getLanguage(),
//                    'module' => $this->config->module->name,
//                    'controller' => 'language',
//                    'action' => 'index',
//
//                ]).'#part_'.$fragment,
//            true
//        );
//        return;

    }
}