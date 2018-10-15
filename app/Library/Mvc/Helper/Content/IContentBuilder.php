<?php
/**
 * Summary File IContentBuilder
 *
 * Description File IContentBuilder
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 3:51 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Helper\Content;

interface IContentBuilder
{
    public function addFormWide(\Lib\Forms\Form $form);

    public function addFormTall(\Lib\Forms\Form $form);

    public function addList(\Lib\Forms\Form $form);

    public function getContent();

}