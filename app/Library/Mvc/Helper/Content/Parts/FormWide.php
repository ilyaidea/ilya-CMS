<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 3:59 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Helper\Content\Parts;

class FormWide extends Form
{
    protected $style = 'wide';

    public function toArray()
    {
        $formResult = parent::toArray();

        $formResult['style'] = $this->style;

        return $formResult;
    }
}