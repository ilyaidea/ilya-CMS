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

    public function addParts($key, $value)
    {
        $this->content[$key][] = $value;
    }

    public function addCss( $css )
    {

        $save = true;
        if(!empty($this->content['css']))
        {
            foreach($this->content['css'] as $part)
            {
                if($css == $part)
                {
                    $save = false;
                }
            }
        }

        if($save)
            $this->addParts('css', $css);
    }

    public function addJs( $js )
    {
        $save = true;
        if(!empty($this->content['js']))
        {
            foreach($this->content['js'] as $part)
            {
                if($js == $part)
                {
                    $save = false;
                }
            }
        }

        if($save)
            $this->addParts('js', $js);
    }

    public function getParts()
    {
        return $this->content;
    }
}