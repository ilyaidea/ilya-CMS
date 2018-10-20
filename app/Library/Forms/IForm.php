<?php
/**
 * Summary File IForm
 *
 * Description File IForm
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/19/2018
 * Time: 4:39 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


interface IForm
{
    public function initElements();
    public function setAttributesElements();
    public function setDefaultElements();
    public function setOptionsElements();
    public function setUserOptionsElements();
    public function setLabelElements();
    public function validationElements();
    public function addElements();
}