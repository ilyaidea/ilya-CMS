<?php

namespace Modules\System\Native\Controllers;

use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Lib\Mvc\Helper\CmsCache;
use Modules\System\Native\DataTables\TranslatesDataTable;
use Modules\System\Native\Forms\TranslateForm;
use Modules\System\Native\Models\Translate;

/**
 * @property Helper $helper
 */
class TranslateController extends Controller
{
    public function indexAction()
    {
        $content = $this->helper->content();
        $content->addDataTable( new TranslatesDataTable() );
    }

    public function addAction()
    {
        $content = $this->helper->content();

        $langForm = $content->addFormWide( new TranslateForm() );

        if( $langForm->isValid() )
        {
            $translateModel              = new Translate();
            $translateModel->phrase      = @$this->request->getPost( 'phrase' );
            $translateModel->translation = @$this->request->getPost( 'translation' );
            $translateModel->language = $this->helper->locale()->getLanguage();

            if( !$translateModel->create() )
            {
                foreach( $translateModel->getMessages() as $message )
                    $langForm->setError( $message );
            }
            else
            {
                CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
                $langForm->setOk( "Savedddd success" );

                // Redirect to Show page
                return $this->response->redirect([
                    'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName()
                ]);
            }
        }
    }

    public function editAction( $editId = null )
    {
        $content = $this->helper->content();

        if( !isset( $editId ) || !is_numeric( $editId ) )
        {
            die( 'Exception' );
        }

        /** @var Translate $translate */
        $translate = Translate::findFirst( [
            "id = :id: AND language = :lang:",
            'bind' => [
                'id' => $editId,
                'lang' => $this->helper->locale()->getLanguage()
            ]
        ] );

        if( !$translate )
        {
            die( 'this lang not exist' );
        }

        $form = new TranslateForm( $translate, [ 'edit' => true ] );

        $langForm = $content->addFormWide( $form );

        if( $langForm->isValid() )
        {
            $translate->phrase       = $this->request->getPost('phrase');
            $translate->translation  = $this->request->getPost('translation');

            if($translate->update())
            {
                $this->flash->success('Success Edit');
                CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());

                // Redirect to Show page
                return $this->response->redirect([
                    'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName()
                ]);
            }
            else
            {
                foreach($translate->getMessages() as $message)
                {
                    $this->flash->error('Error Edit => '. $message);
                }
            }
        }
    }

    public function deleteAction( $ids )
    {
        if( isset($ids) && is_numeric( $ids ) )
        {
            /** @var Translate $translate */
            $translate = Translate::findFirst( $ids );

            if( $translate )
            {
                if($translate->delete())
                {
                    $this->flash->success('Success Delete');
                    CmsCache::getInstance()->save('translates', Translate::buildCmsTranslatesCache());
                }
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