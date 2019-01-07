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

use Lib\Assets\Exception;
use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Modules\System\PageManager\DataTables\PageDataTable;
use Modules\System\PageManager\Forms\PageForm;
use Modules\System\PageManager\Models\Pages\ModelPages;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->content->theme->noLeftMasterPage();

//        $this->content->form(Form::inst(new PageForm(), 'add_form'));
//        $addForm = $this->content->form('add_form');

//        $title = 'register__fa';
//        $search = '__';
////        echo sprintf($title,);
//        $m = explode('__',$title);
//        dump($m);

    }


    public function showAction()
    {
        $this->content->theme->noLeftRightMasterPage();

        $this->content->dataTable(
            DataTable::inst(new PageDataTable(), 'dt_page' ));

        $dt_page = $this->content->dataTable('dt_page');
    }


    public function addAction()
    {
        $parent = $this->request->get('parent');
        $fragment = $this->request->get('fragment');

        $this->content->theme->noLeftMasterPage();

        $this->content->form(Form::inst(new PageForm(), 'add_form'));

        $addForm = $this->content->form('add_form');

        try
        {
            if ($addForm->isValid())
            {
                $page = new ModelPages();

                $page->setParentId($parent);
                $page->setTitle($this->request->getPost('title'));
                $page->setSlug($this->request->getPost('slug'));
                $page->setContent($this->request->getPost('content'));
                $page->setLanguage($this->request->getPost('language'));
                $page->setPosition($this->request->getPost('position'));

                if (! $page->save())
                {
                    throw new \Exception('this id dose not exist');
                }
                else
                {
                    $page->sortByPosition();

                    $this->flash->success('Saved Successfully', $fragment);

                    return $this->response->redirect(
                        $this->url->get(
                            [
                                'for' => 'default__'. $this->helper->locale()->getLanguage(),
                                'module' => $this->config->module->name,
                                'controller' => $this->dispatcher->getControllerName(),
                                'action' => 'show',
                                'params' => $page->getId()
                            ]) .'#part_'.$fragment,
                        true );
                }
            }
        }
        catch (\Exception $exception)
        {
            $this->flash->error($exception->getMessage(), $addForm->prefix);
        }
    }


    public function editAction()
    {
        $id = $this->dispatcher->getParam(0);
        $fragment = $this->request->get('fragment');

        /** @var ModelPages $page */
        $page = ModelPages::findFirst( $id );

        $parent = $page->getParentId();

        if( !$page )
        {
            die( 'the menu dose not exist' );
        }

        $this->content->form(Form::inst(new PageForm($page,[ 'edit' => true ]), 'edit_form'));

        $editForm = $this->content->form('edit_form');

        if( $editForm->isValid() )
        {
            $page->setParentId($parent);
            $page->setTitle($this->request->getPost('title'));
            $page->setSlug($this->request->getPost('slug'));
            $page->setContent($this->request->getPost('content'));
            $page->setLanguage($this->request->getPost('language'));
            $page->setPosition($this->request->getPost('position'));
//            $page->beforUdate();
//            die(print_r($page->toArray()));

            if($page->update())
            {
                $this->flash->success('Edited Successfully',$fragment);

                $page->save();

                $page->sortByPosition();

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
            else
            {
                foreach($page->getMessages() as $message)
                {
                    $this->flash->error('Error Edit => '. $message);
                }
            }
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

}