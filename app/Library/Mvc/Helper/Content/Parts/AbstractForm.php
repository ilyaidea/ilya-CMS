<?php
/**
 * Summary File AbstractForm
 *
 * Description File AbstractForm
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/11/2018
 * Time: 12:26 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper\Content\Parts;


class AbstractForm
{
    public function getElementType($element)
    {
        return strtolower(substr(get_class($element), strrpos(get_class($element), '\\') + 1));
    }
}