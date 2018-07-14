<?php
/**
 * Ilya CMS Created by PhpStorm.
 * User: projekt
 * Date: 5/8/2018
 * Time: 11:13 AM
 */
namespace Modules\Cms\Base\Controllers;

use Modules\Cms\Base\Models\Users;

class SignupController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {

    }

    public function registerAction()
    {
        $user = new Users();

        // Store and check for errors
        $success = $user->save(
            $this->request->getPost(),
            [
                "name",
                "email",
            ]
        );

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }
}