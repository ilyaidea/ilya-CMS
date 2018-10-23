<?php
/**
 * Summary File WidgetLanguageSlector
 *
 * Description File WidgetLanguageSlector
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/21/2018
 * Time: 12:05 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

/*
	Widget Name: Language selector
	Widget URI:
	Widget Description: Language selector description
	Widget Version: 1.0
	Widget Date: 2018-03-27
	Widget Author: Ali Mansoori
	Widget Author URI: https://www.ilyaidea.ir/
	Widget License: GPLv2
	Widget Minimum IlyaIdea Version: 1.4
	Widget Update Check URI:
*/

namespace Modules\System\Native\Widgets;


use Lib\Widget\WidgetAbstract;

class WidgetLanguageSelector extends WidgetAbstract
{
    public function init($params = null)
    {
        return [
            'region' => $params['region'],
            'place' => $params['place']
        ];
    }
}