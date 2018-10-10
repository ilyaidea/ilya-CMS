<?php
/**
 * Summary File LoginController
 *
 * Description File LoginController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/24/2018
 * Time: 8:21 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;

use Lib\Authenticates\Auth;
use Lib\Mvc\Controller;
use Modules\Users\Session\Forms\LoginForm;
use Phalcon\Mvc\View;

/**
 * Summary Class LoginController
 *
 * Description Class LoginController
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Modules\Users\Session\Controllers
 * @version 1.0.0
 * @example Desc <code></code>
 * @property Auth $auth
 */
class LoginController extends Controller
{
    public function indexAction()
    {
        // Check user is logged in
        if ($this->auth->isLoggedIn())
        {
            $this->response->redirect('');
        }

        $this->setEnviroment('backend', 'session');
        $this->view->setRenderLevel(View::LEVEL_LAYOUT);
        $this->tag->setTitle('Log in');
        $this->view->title = 'Log in';

        $loginForm = new LoginForm();

        try
        {
            if ($this->request->isPost() && $loginForm->isValid($this->request->getPost()))
            {
                $this->auth->check();
            }
        }
        catch (\Exception $exception)
        {
            $this->exceptionPrint($exception);
        }

        $this->view->form = $loginForm;
    }

    private function exceptionPrint(\Exception $exception)
    {
        if (is_array($exception->getMessage()))
        {
            foreach ($exception as $e)
            {
                $this->flash->error($e);
            }
        }
        else
        {
            $this->flash->error($exception->getMessage());
        }
    }

}