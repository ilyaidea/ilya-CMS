<?php
/**
 * Summary File Request
 *
 * Description File Request
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/6/2018
 * Time: 1:14 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Phalcon\Mvc\User\Component;

class Request extends Component
{
    /** @var Form $form */
    private $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function getPost($name = null, $filters = null, $defaultValue = null)
    {
        return $_POST;
    }
}