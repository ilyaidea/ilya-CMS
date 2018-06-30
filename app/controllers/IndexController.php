<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:16 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        echo '<h1>Hello!</h1>';
    }

    public function registerAction($param)
    {
        echo "register page = ". $param;
    }
}