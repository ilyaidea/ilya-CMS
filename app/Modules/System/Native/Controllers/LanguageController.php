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
           // dump(Helper\CmsCache::getInstance()->get('languages'));

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
        try
        {
            $langId = $this->dispatcher->getParam(0);
            if (!$langId)
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

//    public function deleteAction( $ids )
//    {
//        if( isset($ids) && is_numeric( $ids ) )
//        {
//            $language = ModelLanguage::findFirst( $ids );
//
//            if( $language )
//            {
//                if($language->delete())
//                    $this->flash->success('Success Delete');
//                else
//                    $this->flash->error('Primary lang can not delete');
//            }
//            else
//            {
//                $this->flash->error('Error Delete 1');
//            }
//        }
//        else
//        {
//            $this->flash->error('Error Delete 2 ');
//        }
//
//        // Redirect to previous page
//        return $this->response->redirect($_SERVER['HTTP_REFERER']);
//    }
}