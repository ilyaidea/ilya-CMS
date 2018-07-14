<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/10/2018
 * Time: 12:01 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Backend\Controllers;

use Lib\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->setEnviroment('backend', 'main');
    }
}