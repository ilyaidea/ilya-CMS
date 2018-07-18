<?php
/**
 * Summary File SignupController
 *
 * Description File SignupController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 7:22 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Controllers;


use Lib\Mvc\Controller;
use Modules\Users\Session\Forms\SignUpForm;
use Phalcon\Mvc\View;

class SignupController extends Controller
{
    public function indexAction()
    {
        $this->setEnviroment('backend', 'main');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $signupForm = new SignUpForm(
            null,
            [

            ]
        );

        if ($this->request->isPost())
        {
            if ($signupForm->isValid($this->request->getPost()))
            {

            }
            else
            {

            }
        }

        $this->view->form = $signupForm;
    }
}