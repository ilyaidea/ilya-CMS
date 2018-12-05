<?php
/**
 * Summary File Options
 *
 * Description File Options
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/3/2018
 * Time: 3:23 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms\Element\FileUploader;

use Lib\Forms\Element\FileUploader;

class Options
{
    /** @var FileUploader $fileUploader */
    public $fileUploader;
    /** @var FileUploader\Options\Ajax $ajax */
    public $ajax;
    /** @var FileUploader\Options\Validation $validation */
    public $validation;

    public function __construct($fileUploader)
    {
        $this->fileUploader = $fileUploader;
        $this->ajax = new FileUploader\Options\Ajax($this);
        $this->validation = new FileUploader\Options\Validation($this);
    }
}