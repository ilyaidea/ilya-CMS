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

use Ilya\Models\Users;
use Lib\Mvc\Test;
use Modules\Users\Session\Lib\Test\Person;
use Modules\Users\Session\Lib\Test\PhoneNumber;
use Phalcon\Mvc\View;

class IndexController extends \Lib\Mvc\Controller
{
    public function indexAction()
    {
        echo "<pre>";
//        $session = $this->session->get('auth');
//
//        $id = $session->id;
//
//        $user = Users::findFirstById($id);
//
//
//        die(
//            print_r($user->getRole())
//        );

        // Client

        $phone = new PhoneNumber();

        $person = new Person($phone);

        $person->setName('reza');

        $person->getHomePhone()->setAreaCode('025');
        $person->getHomePhone()->setPhoneNumber('32916547');

        $person->getOfficePhone()->setAreaCode('021');
        $person->getOfficePhone()->setPhoneNumber('2315489');

        echo "Home => ". $person->getHomePhone()->getNumber();

        echo "<br>";
        echo "<br>";

        echo "Office => ". $person->getOfficePhone()->getNumber();

        $this->view->disable();
    }

    public function errorAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }
}