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
    private $css = [];
    private $js = [];

    public function setParts($key, $value)
    {
        $this->content[$key] = $value;
    }

    public function addParts($key, $value)
    {
        $this->content[$key][$value] = $value;
    }

    public function addCss($value)
    {
        $this->css[$value] = $value;
    }

    public function addJs($value)
    {
        $this->js[$value] = $value;
    }

    public function getParts($key = null)
    {
        $this->content['css'] = array_values($this->css);
        $this->content['js'] = array_values($this->js);

        if($key)
        {
            if(!isset($this->content[$key]))
            {
                return [];
            }

            return $this->content[$key];
        }

        return $this->content;
    }
}