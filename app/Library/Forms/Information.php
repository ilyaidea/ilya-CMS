<?php
/**
 * Summary File Information
 *
 * Description File Information
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/4/2018
 * Time: 9:29 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Lib\Common\Arrays;
use Phalcon\Forms\Element;

class Information
{
    /** @var Title $title */
    public $title;
    /** @var array $tags */
    private $tags = [];
    /** @var Form $form */
    private $form;

    public function __construct(Form $form)
    {
        $this->form  = $form;
        $this->title = new Title();
    }

    /**
     * @param bool $toAttr
     * @return string|array
     */
    public function getTags($toAttr = false)
    {
        if($this->form->getAction())
            $this->appendTag('action', $this->form->getAction());

        $this->appendTag('method', 'post');

        if($toAttr == true)
            return Arrays::arrayToStringTags($this->tags);

        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function addTags( $tags ): void
    {
        if(is_array($tags))
            $this->tags = array_merge($this->tags, $tags);
    }

    public function appendTag($key, $value)
    {
        if($key && $value)
        {
            $this->tags[$key] = $value;
        }
    }
}