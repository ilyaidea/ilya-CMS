<?php
/**
 * Summary File Calender
 *
 * Description File Calender
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/24/2018
 * Time: 5:02 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Users\Session\Widgets;

use Lib\Widget\WidgetAbstract;

class Calender extends WidgetAbstract
{
    public function initialize($params = [])
    {
        return [
            'name' => 'Calender_'. $this->helper->locale()->getLanguage()
        ];
    }
}