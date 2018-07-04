<?php
/**
 * Summary File SignupController
 *
 * Description File SignupController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:17 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

class SignupController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
    }

    public function registerAction()
    {
        $user = new Users();

        // Store and check errors
        $success = $user->save(
            $this->request->getPost(),
            [
                'name',
                'email'
            ]
        );

        if ($success)
        {
            echo "Thanks for registering!";
        }
        else
        {
            echo "Sorry, the following problems: <br>";

            $messages = $user->getMessages();

            foreach ($messages as $message)
            {
                echo $message->getMessage(). '<br>';
            }
        }

        $this->view->disable();
    }
}