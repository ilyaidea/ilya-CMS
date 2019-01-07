<?php
/*
	Widget Name: ModelLanguage selector
	Widget URI:
	Widget Description: ModelLanguage selector description
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
    public function initialize($params = null)
    {
        return [
            'region' => $params['region'],
            'place' => $params['place']
        ];
    }

    private function addCss($params)
    {
    }
}