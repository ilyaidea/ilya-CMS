<?php
/**
 * Summary File Design
 *
 * Description File Design
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/4/2018
 * Time: 9:41 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Phalcon\Forms\Element;

class Design
{
    /** @var Form $form */
    private $form;
    /** @var Element $field */
    private $field;
    /** @var string $style */
    private $style = 'wide';
    private $boxed = false;
    private $columns = 0;
    private $colspan = null;

    private $prefixed = false;
    private $suffixed = false;
    private $skipdata = false;
    private $tworows  = false;

    const STYLE_WIDE = 'wide';
    const STYLE_TALL = 'tall';

    public function __construct($instance)
    {
        if($instance instanceof \Phalcon\Forms\Form)
            $this->form = $instance;

        if($instance instanceof Element)
            $this->field = $instance;

    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle( $style )
    {
        $this->style = $style;
    }

    /**
     * @return bool
     */
    public function isBoxed()
    {
        return $this->boxed;
    }

    /**
     * @param bool $boxed
     */
    public function setBoxed( $boxed )
    {
        $this->boxed = $boxed;
    }

    public function getColumns()
    {
        if(
            (
                $this->form
                &&
                (
                    $this->form->validate->isOk()
                    ||
                    $this->form->elements->hasField()
                )
            )
            ||
            ($this->field && $this->getStyle())
        )
        {
            $this->columns = ($this->getStyle() === Design::STYLE_WIDE) ? 2 : 1;
        }
        return $this->columns;
    }

    public function getColspan()
    {
        if(isset($this->field) && $this->getStyle())
        {
            $this->colspan = $this->getColumns();
        }
        return $this->colspan;
    }

    public function prefixed()
    {
        if(
            $this->field
            &&
            @$this->field->getAttributes('type') == 'checkbox'
            &&
            $this->getColumns() == 1
            &&
            !is_null($this->field->getLabel())
        )
        {
            $this->prefixed = true;
        }
        return $this->prefixed;
    }

    public function suffixed()
    {
        if(
            $this->field
            &&
            (@$this->field->getAttributes('type') == 'select' || @$this->field->getAttributes('type') == 'numeric')
            &&
            $this->getColumns() == 1
            &&
            !is_null($this->field->getLabel())
        )
        {
            $this->suffixed = true;
        }
        return $this->suffixed;
    }

    public function skipdata()
    {
        return $this->skipdata;
    }

    public function tworows()
    {
        if
        (
            $this->field
            &&
            $this->getColumns() == 1
            &&
            !is_null($this->field->getLabel())
            &&
            !$this->skipdata()
            &&
            (
                !($this->prefixed || $this->suffixed)
                ||
                !empty($this->field->getMessages())
                ||
                !empty($this->field->getUserOption('note'))
            )
        )
        {
            $this->tworows = true;
        }
        return $this->tworows;
    }
}