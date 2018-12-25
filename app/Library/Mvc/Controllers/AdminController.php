<?php
namespace Lib\Mvc\Controllers;

use Lib\Authenticates\Auth;
use Lib\Mvc\Controller;

/**
 * @property Auth $auth
 */
class AdminController extends Controller
{
    public function initialize()
    {
        if (!$this->auth->isLoggedIn())
        {
            $to = ltrim(
                $this->router->getRewriteUri(),
                '/'
            );

            $this->flash->notice('Log in please');
            $this->response->redirect($this->url->get([
                    'for' => 'login__'. $this->helper->locale()->getLanguage()
                ]).'?to='. $to,
                true
                );
            $this->response->send();
        }

        parent::initialize();
    }

}