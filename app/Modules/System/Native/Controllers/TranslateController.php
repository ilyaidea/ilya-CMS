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
        try
        {
            $this->content->theme->noLeftRightMasterPage();
            //$content->setTemplate('translate-list', 'ModelTranslate List');
            $this->content->dataTable(
                DataTable::inst(new DtTranslates(),'dtTranslate')
            );
            $this->content->dataTable('dtTranslate');
            $this->content->process();
        }
        catch (\Exception $e)
        {
            dump('ok');
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
            if ($addform->isValid())
            {
                foreach (CmsCache::getInstance()->get('languages') as $language)
                {
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
                    }
                    else {
                        $this->flash->success("Saved for => " . $language['iso']);
                    }
                }//end of foreach

            }//end of if is valid


        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage());

        }
    }

//        $content = $this->helper->content();
//       // $content->setTemplate('translate-add', 'ModelTranslate Add');
//
//        $langForm = $content->addFormWide( new FormTranslate() );
//
//        if( $langForm->isValid() )
//        {
//            foreach(CmsCache::getInstance()->get('languages') as $language)
//            {
//                $translateIsAlreadyExisted = ModelTranslate::findFirst([
//                    'conditions' => 'phrase = :phrase: AND language = :lang:',
//                    'bind' => [
//                        'phrase' => $this->request->getPost( 'phrase' ),
//                        'lang' => $language['iso']
//                    ]
//                ]);
//
//                if($translateIsAlreadyExisted)
//                    continue;
//
//                $translateModel              = new ModelTranslate();
//                $translateModel->phrase      = @$this->request->getPost( 'phrase' );
//
//                $translateModel->translation = null;
//                if($language['iso'] == $this->helper->locale()->getLanguage())
//                    $translateModel->translation = @$this->request->getPost( 'translation' );
//
//                $translateModel->language    = $language['iso'];
//
//                if( !$translateModel->create() )
//                {
//                    foreach( $translateModel->getMessages() as $message )
//                        $langForm->setError( $language['iso']. ' => '. $message );//???????????
//                }
//                else
//                {
//                    $langForm->setOk( "Saved for => ".$language['iso'] );
//                }
//            }
//
//            // Redirect to Show page
//            return $this->response->redirect([
//                'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
//                'module' => $this->config->module->name,
//                'controller' => $this->dispatcher->getControllerName()
//            ]);
//        }
//
//        $content->create();
//    }
//        public function editAction( $editId = null )
//    {
//        $content = $this->helper->content();
//        $content->setTemplate('translate-edit', 'ModelTranslate Edit');
//
//        if( !isset( $editId ) || !is_numeric( $editId ) )
//        {
//            die( 'Exception' );
//        }
//
//        /** @var ModelTranslate $translate */
//        $translate = ModelTranslate::findFirst( [
//            "id = :id: AND language = :lang:",
//            'bind' => [
//                'id' => $editId,
//                'lang' => $this->helper->locale()->getLanguage()
//            ]
//        ] );
//
//        if( !$translate )
//        {
//            die( 'this lang not exist' );
//        }
//
//        $oldPhrase = $translate->phrase;
//
//        $form = new FormTranslate( $translate, [ 'edit' => true ] );
//
//        $langForm = $content->addFormWide( $form );
//
//        if( $langForm->isValid() )
//        {
//            if($oldPhrase !== $this->request->getPost('phrase'))
//            {
//                $translates = ModelTranslate::findByPhrase($oldPhrase);
//
//                foreach($translates as $translate)
//                {
//                    $translate->phrase = $this->request->getPost('phrase');
//                    $translate->update();
//                }
//            }
//            else
//            {
//                $translate->phrase       = $this->request->getPost('phrase');
//                $translate->translation  = $this->request->getPost('translation');
//
//                if($translate->update())
//                {
//                    $this->flash->success('Success Edit');
//
//                    // Redirect to Show page
//                    return $this->response->redirect([
//                        'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
//                        'module' => $this->config->module->name,
//                        'controller' => $this->dispatcher->getControllerName()
//                    ]);
//                }
//                else
//                {
//                    foreach($translate->getMessages() as $message)
//                    {
//                        $this->flash->error('Error Edit => '. $message);
//                    }
//                }
//            }
//        }
//
//        $content->create();
//    }
//
//    public function deleteAction( $id )
//    {
//        if( isset($id) && is_numeric( $id ) )
//        {
//            /** @var ModelTranslate $translate */
//            $translate = ModelTranslate::findFirst( [
//                'conditions' => 'id = :id:',
//                'columns' => 'phrase',
//                'bind' => [
//                    'id' => $id
//                ]
//            ] );
//
//
//            if( $translate )
//            {
//                $translates = ModelTranslate::findByPhrase($translate->phrase);
//
//                if($translates->delete())
//                {
//                    $this->flash->success('Success Delete');
//                }
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
//        // Redirect to Show page
//        return $this->response->redirect([
//            'for' => 'default_action__'. $this->helper->locale()->getLanguage(),
//            'module' => $this->config->module->name,
//            'controller' => $this->dispatcher->getControllerName()
//        ]);
//    }
}