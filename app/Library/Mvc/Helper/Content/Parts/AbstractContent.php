<?php
/**
 * Summary File AbstractContent
 *
 * Description File AbstractContent
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 4:13 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper\Content\Parts;


abstract class AbstractContent
{
    private $content = [];

    public function setParts($key, $value)
    {
        $this->content[$key] = $value;
    }

    public function getParts()
    {
        return $this->content;
    }
}