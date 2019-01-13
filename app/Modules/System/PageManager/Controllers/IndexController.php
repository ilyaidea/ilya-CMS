<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/22/2018
 * Time: 11:03 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\PageManager\Controllers;

use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Exception;
use Lib\Mvc\Controller;
use Modules\Notification\News\Models\Keywords;
use Modules\System\PageManager\DataTables\PageDataTable;
use Modules\System\PageManager\Forms\PageForm;
use Modules\System\PageManager\Models\Keywords\ModelKeywords;
use Modules\System\PageManager\Models\Pages\ModelPages;

class IndexController extends Controller
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Actions
     */

    public function showAction()
    {
        try
        {
            $this->content->theme->noLeftRightMasterPage();

            $this->content->dataTable(
                DataTable::inst(new PageDataTable(), 'dt_page' ));
        }
        catch(\Exception $exception)
        {
            $this->flash->error($exception->getMessage());
        }
    }


    public function addAction()
    {
        $this->content->theme->noLeftMasterPage();

        $this->content->form(Form::inst(new PageForm(), 'add_form'));

        $addForm = $this->content->form('add_form');

        try
        {
            if ($addForm->isValid())
            {
                $page = new ModelPages();
                $result = $page->createPageForRequest($this);

                if($result == true) // This means the page has been successfully saved
                {
                    ModelKeywords::saveKeywords($page->getId(),$this->request->getPost('keywords'));

                    $this->flash->success('This page was successfully saved', $this->getFragmentFromGetRequest());

                    $this->redirectToShowAction();
                }
                else // This means that the page has not been successfully saved
                {
                    throw new Exception(implode(', ', $page->getMessages()));
                }
            }
        }
        catch (Exception $exception)
        {
            $this->flash->error($exception->getMessage(), $addForm->prefix);
        }
    }


    public function editAction()
    {
        try
        {
            $pageId = $this->validatePageId();

            /** @var ModelPages $page */
            $page = ModelPages::findFirst( $pageId );

            if(!$page)
                throw new Exception('This page does not exist !');

            $editForm = $this->createPageForm($page, [ 'edit' => true ]);

            if( $editForm->isValid() )
            {
                $result = $page->updatePageForRequest($this);

                if($result)
                {
                    $this->flash->success('Edited Successfully',$this->getFragmentFromGetRequest());
                    $this->redirectToShowAction();
                }
                else
                    throw new Exception(implode(', ', $page->getMessages()));
            }
        }
        catch(Exception $exception)
        {
            $this->flash->error($exception->getMessage());
        }
    }


    public  function deleteAction()
    {
        $id = $this->dispatcher->getParam(0);
        $fragment = $this->request->get('fragment');

        try
        {
            /** @var $page ModelPages */
            $page = ModelPages::findFirst($id);
//            dump($page);

            if (!$page)
            {
                throw new \Exception('this id dose not exist');
            }

            if (!$page->delete())
            {
                foreach ($page->getMessages() as $e)
                {
                    throw new \Exception($e);
                }
            }
            else
            {
                $page->sortByPosition();

                $this->flash->success('Deleted Successfully', $fragment);
            }
        }

        catch(\Exception $exception)
        {
            $this->flash->error($exception->getMessage(), $fragment);
        }

        return $this->response->redirect(
            $this->url->get(
                [
                    'for' => 'default__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName(),
                    'action' => 'show',
                ]) .'#part_'.$fragment,
            true );
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Private Methods
     */

    private function redirectToShowAction()
    {
        $this->response->redirect(
            $this->url->get(
                [
                    'for' => 'default__'. $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName(),
                    'action' => 'show'
                ]) .'#part_'.$this->getFragmentFromGetRequest(),
            true );
        $this->response->send();
    }

    private function validatePageId()
    {
        $pageId = $this->dispatcher->getParam(0);

        if(!(isset($pageId) && is_numeric($pageId)))
        {
            throw new Exception('Param page_id is required');
        }

        return $pageId;
    }

    private function createPageForm($entity = null, $options = [])
    {
        $this->content->form(Form::inst(new PageForm($entity, $options), 'form'));

        return $this->content->form('form');
    }

}