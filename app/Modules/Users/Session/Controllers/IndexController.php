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

use Ilya\Models\Lang;
use Modules\Users\Session\Forms\LoginForm;
use Modules\Users\Session\Models\UserFieldsCategory;
use Phalcon\Mvc\View;

class IndexController extends \Lib\Mvc\Controller
{
    public function indexAction()
    {
        echo "<pre>";

//        $categories = UserFieldsCategory::findFirst(1);

        $langs = Lang::find();

        $row = [];
        foreach ($langs as $lang)
        {
            $testArray = [];
            $testArray['title'] = $lang->title;
            $testArray['value'] = $lang->value;

            $testArray['categories'] = [];
            foreach ($lang->userFieldsCategories as $key => $category)
            {
                $testArray['categories'][$key]['title'] = $category->title;
                $testArray['categories'][$key]['fields'] = $category->getFields()->toArray();
            }

            $row[] = $testArray;
        }

        print_r($row);


        $this->view->disable();
    }
}