<?php
/**
 * Summary File Buttons
 *
 * Description File Buttons
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/31/2018
 * Time: 9:37 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


class Buttons
{
    /** @var Form $form */
    private $form;

    private $buttons = [];

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function add($name)
    {
        $button = new Button();
        $button->setName($name);
        $this->buttons[$name] = $button;
        return $button;
    }

    public function get()
    {
        return $this->buttons;
    }
}