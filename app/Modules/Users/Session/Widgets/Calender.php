<?php
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