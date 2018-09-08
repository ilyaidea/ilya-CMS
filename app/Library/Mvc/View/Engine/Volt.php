<?php
/**
 * Summary File Volt
 *
 * Description File Volt
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/31/2018
 * Time: 10:01 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\View\Engine;

class Volt extends \Phalcon\Mvc\View\Engine\Volt
{
    public function initCompiler()
    {
        $compiler = $this->getCompiler();

        $compiler->addFunction('strlen', 'strlen');
        $compiler->addFunction('in_array', 'in_array');
        $compiler->addFunction('is_array', 'is_array');
        $compiler->addFunction('json_encode', 'json_encode');
        $compiler->addFunction('json_decode', 'json_decode');
        $compiler->addFunction('array_merge', 'array_merge');
    }
}