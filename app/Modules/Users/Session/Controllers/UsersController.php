<?php
/**
 * Summary File UsersController
 *
 * Description File UsersController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/15/2018
 * Time: 12:53 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use Lib\Contents\Classes\DataTable;
use Lib\Contents\Classes\Form;
use Lib\Mvc\Controller;
use Lib\Mvc\Model\Users\ModelUsers;
use Modules\Users\Session\DataTable\UserDataTable;
use Modules\Users\Session\Forms\RegisterForm;

class UsersController extends Controller
{

    public function indexAction()
    {
       $this->request->getServerAddress();
    }

    public function showAction()
    {

        $this->content->theme->noLeftRightMasterPage();

       // dump('ok');

        $this->content->dataTable(
            DataTable::inst(new UserDataTable(),'dt_users')
        );

        $this->content->dataTable('dt_users');


    }

    public function addAction()
    {
        $this->content->theme->noLeftRightMasterPage();

        $this->content->form(
            Form::inst(new RegisterForm(),'add_form')
        );

        $addForm = $this->content->form('add_form');

        if($addForm->isValid())
        {
//            dump($_POST);

            $users = new ModelUsers();

            $users->setUsername('username');

            $users->setEmail($this->request->getPost('email'));

            $users->setPassword($this->request->getPost('password'));



            if(!$users->save())
            {
                $this->flash->error($users->getMessages(),$addForm);
            }
            else
            {
                $this->flash->success('success', $addForm);

                $this->response->redirect([
                    'for' => 'default__' . $this->helper->locale()->getLanguage(),
                    'module' => $this->config->module->name,
                    'controller' => $this->dispatcher->getControllerName(),
                    'action' => 'show',
                ]);

                return;
            }
        }

    }

    public function editAction()
    {
        $fragment = $this->request->get('fragment');
        $user_id = $this->dispatcher->getParam(0);


        try {

            if (!$fragment)
            {
                throw new \Exception('fragment is not exist');
            }
            if (!$user_id || !is_numeric($user_id))
            {
                throw new \Exception('user_id is not exist');
            }

            /** @var ModelUsers $user */
            $user = ModelUsers::findFirst($user_id);



            if (!$user)
            {
                throw new \Exception('user is not exist');
            }

            $this->content->form(Form::inst(new RegisterForm($user,['edit'=> true]), 'edit_form'));

            $editForm = $this->content->form('edit_form');

            if ($editForm->isValid())
            {

                /** @var ModelUsers $user */
                //  $category->setParentId($parent);

                $user->setUsername($this->request->getPost('username'));

                $user->setEmail($this->request->getPost('email'));

                $user->setPassword($this->request->getPost('password'));


                if (!$user->update())
                {
                    throw new \Exception('user is not update');
                }

                else
                {
                    $this->flash->success('Success Edit ', $editForm);

                    $this->response->redirect(
                        $this->url->get([
                            'for' => 'default__' . $this->helper->locale()->getLanguage(),
                            'module' => $this->config->module->name,
                            'controller' => 'users',
                            'action' => 'show'
                        ]) . '#part_' . $fragment,
                        true
                    );

                    return;
                }
            }
        }
        catch (\Exception $exception)
        {
            $this->flash->error($exception->getMessage());
        }

        return;

    }

    public function deleteAction()
    {
        $fragment = $this->request->get('fragment');
        $user_id = $this->dispatcher->getParam(0);

        try
        {
            if(!$user_id || !is_numeric($user_id))
            {
                throw new \Exception('user_id is not exist');
            }
            if(!$fragment)
            {
                throw new \Exception('fragment is not exist');
            }
            /**
             * @var ModelUsers $user
             */
            $user = ModelUsers::findFirstById($user_id);


            if(!$user)
            {
                throw new \Exception('user is not exist');
            }
            if(!$user->delete())
            {
                foreach ($user->getMessages() as $message)
                {
                    throw  new \Exception($message);
                }
            }
            $this->flash->success('Success Delete '.$user->getUsername(),$fragment);
        }
        catch (\Exception $exception)
        {
            $this->flash->error($exception->getMessage());
        }

        $this->response->redirect(
            $this->url->get([
                'for' => 'default__'. $this->helper->locale()->getLanguage(),
                'module' => $this->config->module->name,
                'controller' => 'users',
                'action' => 'show'
            ]).'#part_'.$fragment,
            true
        );

        return;
    }

}