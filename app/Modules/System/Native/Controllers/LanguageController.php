<?php

namespace Modules\System\Native\Controllers;

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
        $content = $this->helper->content();
        $content->setTemplate('languages-list', 'Lang List');
        $content->addDataTable( new LanguagesDataTable() );
        $content->create();
    }

    public function addAction()
    {
        $content = $this->helper->content();
        $content->setTemplate('languages-add', 'Lang Add');

        $langForm = $content->addFormWide( new LanguageForm() );

        if( $langForm->isValid() )
        {
            $languageModel              = new Language();
            $languageModel->title       = @$this->request->getPost( 'title' );
            $languageModel->iso         = @$this->request->getPost( 'iso' );
            $languageModel->position    = @$this->request->getPost( 'position' );
            $languageModel->is_primary  = @$this->request->getPost( 'is_primary' );
            $languageModel->direction   = @$this->request->getPost( 'direction' );

            if( !$languageModel->create() )
            {
                foreach( $languageModel->getMessages() as $message )
                    $langForm->setError( $message );
            } else
            {
                $languageModel->setOnlyOnePrimary();
                $langForm->setOk( "Savedddd success" );

                // Redirect to Show page
                return $this->response->redirect([
                    'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName()
                ]);
            }
        }

        $content->create();
    }

    public function editAction( $editId = null )
    {
        $content = $this->helper->content();
        $content->setTemplate('languages-edit', 'Lang Edit');

        if( !isset( $editId ) || !is_numeric( $editId ) )
        {
            die( 'Exception' );
        }

        /** @var Language $language */
        $language = Language::findFirstById( $editId );

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

    public function deleteAction( $ids )
    {
        if( isset($ids) && is_numeric( $ids ) )
        {
            $language = Language::findFirst( $ids );

            if( $language )
            {
                if($language->delete())
                    $this->flash->success('Success Delete');
                else
                    $this->flash->error('Primary lang can not delete');
            }
            else
            {
                $this->flash->error('Error Delete 1');
            }
        }
        else
        {
            $this->flash->error('Error Delete 2 ');
        }

        // Redirect to previous page
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}