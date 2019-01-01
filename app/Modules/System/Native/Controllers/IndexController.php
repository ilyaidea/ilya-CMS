<?php

namespace Modules\System\Native\Controllers;

use Lib\Mvc\Controller;
use Lib\Mvc\Helper;
use Modules\System\Native\Forms\FormLanguage;
use Modules\System\Native\Models\Language;

class IndexController extends Controller
{
    public function indexAction()
    {
       // $content = $this->helper->content();
        $this->content->theme->noLeftRightMasterPage();
       // $content->setTemplate('native index', 'Native index');

       $this->content->process();
    }
}