<?php

namespace Modules\System\Native\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Lib\Tag;
use Modules\System\Native\DataTables\Languages;
use Modules\System\Native\DataTables\DtLanguages;
use Modules\System\Native\Forms\FormLanguage;
use Modules\System\Native\Models\Language;

class LanguageController extends Controller
{
    public function indexAction()
    {
       $this->content->theme->noLeftRightMasterPage();
        try
        {
            $this->content->dataTable(
                DataTable::inst(new DtLanguages(), 'dtLang')
            );
            $this->content->dataTable('dtLang');
        }
        catch (\Exception $exception)
        {
            $this->flash->error($exception->getMessage());
        }
    }

    public function addAction()
    {
//        Tag::setTitle('اضافه کردن');
//        Tag::appendTitle('adddd');
        //Tag::setMetaDescription('description');
        try {
            $fragment = $this->request->get('fragment');
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

                if (!$language->save())
                 {
                    foreach ($language->getMessages() as $message)
                        $this->flash->error($message,$add_form);
                 }
                else
                {
                    $this->flash->success('language is added',$fragment);
                }
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
                $this->response->send();
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
        $fragment = $this->request->get('fragment');
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

                    $this->flash->success('success edited =>'.$language->getTitle(),$fragment);
                }
                else
                {
                    foreach ($language->getMessages() as $message)
                        $this->flash->error($message,$edit_form);
                }
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
                $this->response->send();
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
            $this->flash->success('deleted successfully => '.$language->getTitle(),$fragment);

        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage(),$fragment);

        }
        $this->response->redirect(
            $this->url->get([
                'for'        => 'default__'.$this->helper->locale()->getLanguage(),
                'module'     => $this->config->module->name,
                'controller' => $this->dispatcher->getControllerName(),
                'action'     => 'index'
            ]),
            true
        );
        return;
    }
}