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
class IndexController extends Controller
{
    public function indexAction()
    {
        $content = $this->helper->content();
        $content->setTemplate('test-template', $this->helper->t('test_template'));
        $content->getTheme()->noLeftMasterPage();
        $content->addTreeMenu(new TreeMenuTest());

        $content->create();
    }

    public function testAction()
    {
        $page = new ModelPages();

        $page->setParentId(null);
        $page->setTitle('PAGE 2');

//        $page->setLanguage('en');

        $saved = $page->save();

        if(!$saved)
        {
            dump($page->getMessages());
        }

        dump('Success Saved!');
    }
}