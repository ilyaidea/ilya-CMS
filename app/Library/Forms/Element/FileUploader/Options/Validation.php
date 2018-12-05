<?php
/**
 * Summary File Validation
 *
 * Description File Validation
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/3/2018
 * Time: 4:00 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms\Element\FileUploader\Options;


use Lib\Forms\Element\FileUploader\Options;

class Validation
{
    /** @var Options $options */
    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Set / The maximum allowed file size in bytes.
     *
     * @param integer $int
     * @example 1 // 1 Byte
     * @return Validation
     */
    public function setMaxFileSize($int)
    {
        if(is_numeric($int))
            $this->options->fileUploader->storageOptions['maxFileSize'] = $int;

        return $this;
    }

    /**
     * Get / The maximum allowed file size in bytes. Default is "undifined"
     *
     * @return null|integer
     */
    public function getMaxFileSize()
    {
        if(isset($this->options->fileUploader->storageOptions['maxFileSize']))
        {
            return $this->options->fileUploader->storageOptions['maxFileSize'];
        }
        return null;
    }

    /**
     * Set / This option limits the number of files that are allowed to be uploaded using this widget.
     * By default, unlimited file uploads are allowed.
     *
     * @param integer $int
     * @return $this
     * @version 1.0.0
     * @example Example: 10
     */
    public function setMaxNumberOfFiles($int)
    {
        if(is_numeric($int))
            $this->options->fileUploader->storageOptions['maxNumberOfFiles'] = $int;

        return $this;
    }

    /**
     * Get / This option limits the number of files that are allowed to be uploaded using this widget.
     * By default, unlimited file uploads are allowed.
     *
     * @return null|integer
     * @example Example: 10
     */
    public function getMaxNumberOfFiles()
    {
        if(isset($this->options->fileUploader->storageOptions['maxNumberOfFiles']))
        {
            return $this->options->fileUploader->storageOptions['maxNumberOfFiles'];
        }
        return null;
    }
}