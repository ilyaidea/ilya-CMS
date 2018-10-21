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
        $content = $this->helper->content();

        $langForm = $content->addFormWide( new TranslateForm() );

        if( $langForm->isValid() )
        {
            foreach(CmsCache::getInstance()->get('languages') as $language)
            {
                $translateIsAlreadyExisted = Translate::findFirst([
                    'conditions' => 'phrase = :phrase: AND language = :lang:',
                    'bind' => [
                        'phrase' => $this->request->getPost( 'phrase' ),
                        'lang' => $language['iso']
                    ]
                ]);

                if($translateIsAlreadyExisted)
                    continue;

                $translateModel              = new Translate();
                $translateModel->phrase      = @$this->request->getPost( 'phrase' );

                $translateModel->translation = null;
                if($language['iso'] == $this->helper->locale()->getLanguage())
                    $translateModel->translation = @$this->request->getPost( 'translation' );

                $translateModel->language    = $language['iso'];

                if( !$translateModel->create() )
                {
                    foreach( $translateModel->getMessages() as $message )
                        $langForm->setError( $language['iso']. ' => '. $message );
                }
                else
                {
                    $langForm->setOk( "Saved for => ".$language['iso'] );
                }
            }

            // Redirect to Show page
            return $this->response->redirect([
                'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
                'module' => $this->config->module->name,
                'controller' => $this->dispatcher->getControllerName()
            ]);
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

        $oldPhrase = $translate->phrase;

        $form = new TranslateForm( $translate, [ 'edit' => true ] );

        $langForm = $content->addFormWide( $form );

        if( $langForm->isValid() )
        {
            if($oldPhrase !== $this->request->getPost('phrase'))
            {
                $translates = Translate::findByPhrase($oldPhrase);

                foreach($translates as $translate)
                {
                    $translate->phrase = $this->request->getPost('phrase');
                    $translate->update();
                }
            }
            else
            {
                $translate->phrase       = $this->request->getPost('phrase');
                $translate->translation  = $this->request->getPost('translation');

                if($translate->update())
                {
                    $this->flash->success('Success Edit');

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
    }

    public function deleteAction( $id )
    {
        if( isset($id) && is_numeric( $id ) )
        {
            /** @var Translate $translate */
            $translate = Translate::findFirst( [
                'conditions' => 'id = :id:',
                'columns' => 'phrase',
                'bind' => [
                    'id' => $id
                ]
            ] );


            if( $translate )
            {
                $translates = Translate::findByPhrase($translate->phrase);

                if($translates->delete())
                {
                    $this->flash->success('Success Delete');
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

        // Redirect to Show page
        return $this->response->redirect([
            'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
            'module' => $this->config->module->name,
            'controller' => $this->dispatcher->getControllerName()
        ]);
    }
}