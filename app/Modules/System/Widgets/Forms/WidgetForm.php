<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/07/2019
 * Time: 07:57 PM
 */

namespace Modules\System\Widgets\Forms;

use Lib\Forms\Element\Check;
use Lib\Forms\Element\CheckBoxList;
use Lib\Forms\Element\Submit;
use Lib\Forms\Form;
use Modules\System\Widgets\Lib\WidgetDetails;

class WidgetForm extends Form
{
    public function init()
    {
        $this->formInfo->title->set('Widget Form');

        $this-> addWidget();

        $this->addSave();
    }

    /*
     ساختن چک باکس برای ویجت ها *
     */
    public function addWidget()
    {
        $array = $this->findWidgetName();
        $widget = new CheckBoxList(
            'widget',$array,null,[
                'class' => 'checkBoxList'
            ]
        );
        $widget->setDefault(false);
        $widget->setLabel('Widget : ');
        $this->add($widget);
    }

    public function addSave()
    {
        $save = new Submit('save');

        $save-> setLabel('Save');

        $this-> add($save);
    }

    /*
     * تابعی برای پیدا کردن نام ویجت ها
     */
    public function findWidgetName()
    {
        $widgetName = WidgetDetails::WidgetList();
        $array = [];
        foreach ($widgetName as $value) {

            $widget = array_values($value);

            $array[]=$widget[2];
        }
        return $array;

    }

}