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


use Phalcon\Forms\Element;

class Elements
{
    /** @var Form $form */
    private $form;

    /** @var array $fields */
    private $fields = [];
    /** @var array $buttons */
    private $buttons = [];
    /** @var array $hiddens */
    private $hiddens = [];

    public function __construct(Form $form)
    {
        $this->form  = $form;
    }

    /**
     * @return bool
     */
    public function hasField()
    {
        if(!empty($this->getFields()))
            return true;

        return false;
    }

    public function getFields()
    {
        /** @var Element $element */
        foreach($this->form->getElements() as $element)
        {
            if(!($element->getAttributes('type') == 'hidden' || $element->getAttributes('type') == 'submit'))
            {
                $this->fields[$element->getName()] = $element;
            }
        }

        return $this->fields;
    }

    /**
     * @return bool
     */
    public function hasButton()
    {
        if(!empty($this->getButtons()))
            return true;

        return false;
    }

    public function getButtons()
    {
        /** @var Element $element */
        foreach($this->form->getElements() as $element)
        {
            if($element->getAttributes('type') == 'submit')
            {
                $this->buttons[$element->getName()] = $element;
            }
        }

        return $this->buttons;
    }

    /**
     * @return bool
     */
    public function hasHidden()
    {
        if(!empty($this->getHiddens()))
            return true;

        return false;
    }

    public function getHiddens()
    {
        /** @var Element $element */
        foreach($this->form->getElements() as $element)
        {
            if($element->getAttributes('type') == 'hidden')
            {
                $this->hiddens[$element->getName()] = $element;
            }
        }

        return $this->hiddens;
    }
}