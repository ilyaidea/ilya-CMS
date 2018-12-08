<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 6:49 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Users\Session\Controllers;

use Ilya\Models\Blobs;
use Ilya\Models\Users;
use Lib\Authenticates\Auth;
use Lib\Mvc\Helper;
use Modules\Users\Session\Forms\LoginForm;
use Modules\Users\Session\Forms\SignUpForm;

/**
 * @property Helper $helper
 * @property Auth $auth
 */
class IndexController extends \Lib\Mvc\Controller
{
    public function indexAction()
    {
        // Check user is logged in
        if ($this->auth->isLoggedIn())
        {
            $this->response->redirect('');
        }

        $content = $this->helper->content();
        $content->setTemplate('session-template', 'Session Template');

        $loginForm = $content->addFormWide(new LoginForm());
        $signupForm = $content->addFormTall(new SignUpForm());

        $content->getTheme()->noLeftMasterPage();
//        $content->getTheme()->noRightMasterPage();
//        $content->getTheme()->noLeftRightMasterPage();
//        $content->getTheme()->viewMasterPage();

        if($loginForm->isValid())
        {
            try
            {
                $this->auth->check();
            }
            catch( \Exception $e )
            {
                $this->flash->success($e->getMessage());
            }
        }



        if($signupForm->isValid())
        {
            $user = new Users(
                [
                    'username' => $this->request->getPost('username', 'striptags'),
                    'email'    => $this->request->getPost('email', [
                        'striptags',
                        'email'
                    ]),
                    'password' => $this->request->getPost('password'),
                    'active'   => true
                ]
            );

            if ($user->save())
            {
                $this->flash->success('Success save');
            }
            else
            {
                foreach ($user->getMessages() as $message)
                {
                    $this->flash->error($message);
                }
            }
        }

        $content->create();
    }
}