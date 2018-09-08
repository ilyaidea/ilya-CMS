<?php
/**
 * Summary File UserFieldsCategory
 *
 * Description File UserFieldsCategory
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/15/2018
 * Time: 12:56 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use DataTables\DataTable;
use Ilya\Models\Lang;
use Lib\DataTables\Resultset;
use Lib\Mvc\Helper\CmsCache;
use Modules\Users\Session\Forms\CategoryForm;
use Modules\Users\Session\Models\UserFieldsCategory;
use Phalcon\Mvc\View;

/**
 * Summary Class CategoryController
 *
 * Description Class CategoryController
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Modules\Users\Session\Controllers
 * @version 1.0.0
 * @example Desc <code></code>
 * @property \Lib\DataTables\DataTable $dataTable
 */
class CategoryController extends ControllerBase
{
    public function initialize ()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        if ( $this->session->get( 'auth' ) == null )
        {
            $this->response->redirect( 'login' );
        }
        $this->setEnviroment( 'backend', 'main' );
    }

    public function indexAction ()
    {
        die( 'CategoryController' );
    }

    public function showAction ()
    {
        if ( $this->request->isAjax() )
        {

            $categories = UserFieldsCategory::find();

            $row = [];
            foreach ( $categories as $category )
            {
                $row[] = [
                    'id'    => $category->id,
                    'title' => $category->title,
                    'lang'  => $category->lang->title
                ];
            }
            $this->sortForDataTable($row);
        }

        //        $this->dataTable->dom()->set('Bfrtip');
        //        $this->dataTable->serverSide()->set(true);
        //        $this->dataTable->ajax()->set($this->request->getURI());
        //        $this->dataTable->buttons()->set([
        //            'text' => 'my button',
        //        ]);
        //
        //        $this->dataTable
        //            ->columns()
        //                ->setData('ufc__id')
        //                ->setName('ID')
        //                ->register();
        //
        //        $this->dataTable
        //            ->columns()
        //                ->setData('ufc__title')
        //                ->setName('Title')
        //                ->register();

        //        die(print_r(json_decode($this->dataTable->getOptions())));
        //        $resultset = Resultset::inst();
        //        $resultset->from(['ufc' => 'Modules\Users\Session\Models\UserFieldsCategory']);
        //        $resultset->process($this->request->getPost());
        //        $resultset->json();


        //        $this->view->dataTable = '';
        //        $this->view->setRenderLevel( View::LEVEL_ACTION_VIEW );
    }

    public function addAction ()
    {
        $categoryForm = new CategoryForm();

        try
        {
            if ( $this->request->isPost() && $categoryForm->isValid( $this->request->getPost() ) )
            {
                $categoryModel = new UserFieldsCategory(
                    [
                        'title'    => $this->request->getPost( 'title', 'striptags' ),
                        'content'  => $this->request->getPost( 'content' ),
                        'lang_id'  => $this->request->getPost( 'lang' ),
                        'position' => $this->request->getPost( 'position' )
                    ]
                );

                if ( $categoryModel->save() )
                {
                    $categoryForm->clear();
                    $this->flash->success( 'Category saved' );
                    $this->response->redirect( 'session/category/show' );
                } else
                {
                    foreach ( $categoryModel->getMessages() as $message )
                    {
                        $this->flash->error( 'Db error => '.$message );
                    }
                }

            }
        } catch ( \Exception $e )
        {
            $this->flash->error( $e );
        }

        $this->setEnviroment( 'backend', 'main' );
        $this->view->form = $categoryForm;
    }

    public function editAction ( $catId = null )
    {
        try
        {
            if ( is_null( $catId ) )
            {
                throw new \Exception( 'Access denied' );
            }

            $category = UserFieldsCategory::findFirst( $catId );

            if ( !$category )
            {
                throw new \Exception( 'Category dont exist' );
            }

            $categoryForm = new CategoryForm( $category, [ 'edit' => true ] );

            if ( $this->request->isPost() && $categoryForm->isValid( $this->request->getPost() ) )
            {
                $category->title = $this->request->getPost( 'title' );
                $category->content = $this->request->getPost( 'content' );
                $category->lang_id = $this->request->getPost( 'lang' );
                $category->position = $this->request->getPost( 'position' );

                if ( !$category->update() )
                {
                    throw new \Exception( $category->getMessages() );
                }

                $this->flash->success( $category->title.' Updated' );

                $this->response->redirect( 'session/category/show' );
            }

        } catch ( \Exception $exception )
        {
            if ( is_array( $exception ) )
            {
                foreach ( $exception as $message )
                {
                    $this->flash->error( $message );
                }
            } else
            {
                $this->flash->error( $exception );
            }
        }

        $this->view->form = $categoryForm;
    }

    public function deleteAction ( $catId = null )
    {
        $category = UserFieldsCategory::findFirst( $catId );

        try
        {
            if ( !$category )
            {
                throw new \Exception( "Category doesn't exist " );
            }

            if ( !$category->delete() )
            {
                throw new \Exception( $category->getMessages() );
            }

            $this->flash->success( $category->title.' deleted' );
        } catch ( \Exception $e )
        {
            if ( is_array( $e ) )
            {
                foreach ( $e as $message )
                {
                    $this->flash->error( $message );
                }
            } else
            {
                $this->flash->error( $e );
            }
        }

        $this->response->redirect( 'session/category/show' );
    }

    private function sortForDataTable ( $data )
    {
        $row = [];

        foreach ( $data as $items )
        {
            $row[] = array_merge(
                [ 'DT_RowId' => 'row_'.$items[ 'id' ] ],
                $items
            );
        }

        $result[ 'data' ] = $row;
        $result[ 'options' ] = [];
        $result[ 'files' ] = [];

        echo json_encode( $result );
        die;
    }
}