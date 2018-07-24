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


use Ilya\Models\Users;
use Lib\Mvc\Controller;
use Phalcon\Mvc\View;

class LoginController extends Controller
{
    public function indexAction()
    {
        $this->setEnviroment('backend', 'session');
        $this->view->setRenderLevel(View::LEVEL_LAYOUT);
        $this->tag->setTitle('Log in');
        $this->view->title = 'Log in';
    }
}