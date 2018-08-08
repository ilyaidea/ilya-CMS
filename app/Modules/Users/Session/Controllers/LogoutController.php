<?php
/**
 * Summary File LogoutController
 *
 * Description File LogoutController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/4/2018
 * Time: 10:59 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use Lib\Authenticates\Auth;
use Lib\Mvc\Controller;

/**
 * Summary Class LogoutController
 *
 * Description Class LogoutController
 *
 * @author Ali Mansoori
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 * @package Modules\Users\Session\Controllers
 * @version 1.0.0
 * @example Desc <code></code>
 * @property Auth $auth
 */
class LogoutController extends Controller
{
    public function indexAction()
    {
        $this->auth->remove();

        $this->flash->notice('User is not login');
        return $this->response->redirect('login');
    }

}