<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/22/2018
 * Time: 11:03 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\PageManager\Controllers;

use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Modules\System\Native\Models\Language;
use Modules\System\PageManager\Models\Pages\ModelPages;
use Modules\System\PageManager\TreeMenus\TreeMenuTest;

/**
 * @property Helper helper
 */
class AssetsController extends Controller
{
    public function indexAction()
    {
        dump($this->dispatcher->getParams());
    }
}