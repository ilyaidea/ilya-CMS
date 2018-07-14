<?php
/**
 * Summary File FrontendWidget
 *
 * Description File FrontendWidget
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/5/2018
 * Time: 5:19 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Support\Frontend\Widget;

use Lib\Widget\AbstractWidget;

class FrontendWidget extends AbstractWidget
{
    public function initialize($param)
    {
        $widget = $param['widget'];
        $options = $param['options'];
        $this->$widget($options);
    }

    public function lastNews($options = [])
    {
        $this->widgetPartial('widget/last-news');
    }

}