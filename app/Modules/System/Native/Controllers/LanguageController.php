<?php

namespace Modules\System\Native\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Modules\System\Native\DataTables\Languages;
use Modules\System\Native\DataTables\LanguagesDataTable;
use Modules\System\Native\Forms\LanguageForm;
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
                DataTable::inst(new LanguagesDataTable(), 'dtLang')
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
                Form::inst(new LanguageForm(), 'add_form')
            );
            $add_form = $this->content->form('add_form');
            if ($add_form->isValid()) {
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

        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage());

        }

        $content = $this->helper->content();
        $content->setTemplate('languages-edit', 'Lang Edit');

        if( !isset( $editId ) || !is_numeric( $editId ) )
        {
            die( 'Exception' );
        }

        /** @var ModelLanguage $language */
        $language = ModelLanguage::findFirstById( $editId );

        if( !$language )
        {
            die( 'this lang not exist' );
        }

        $form = new LanguageForm( $language, [ 'edit' => true ] );

        $langForm = $content->addFormWide( $form );

        if( $langForm->isValid() )
        {
            $language->is_primary = ($this->request->getPost('is_primary')) ? $this->request->getPost('is_primary') : 0;
            $language->title      = @$this->request->getPost('title');
            $language->iso        = @$this->request->getPost('iso');
            $language->position   = @$this->request->getPost('position');
//            echo "<pre>";
//            die(print_r($language->toArray()));

            if($language->update())
            {
                $this->flash->success('Success Edit');

                $language->setOnlyOnePrimary();

                // Redirect to Show page
                return $this->response->redirect([
                    'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName()
                ]);

            }
            else
            {
                foreach($language->getMessages() as $message)
                {
                    $this->flash->error('Error Edit => '. $message);
                }
            }
        }

        $content->create();
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