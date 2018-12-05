<?php
/**
 * Summary File Ajax
 *
 * Description File Ajax
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/3/2018
 * Time: 3:39 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms\Element\FileUploader\Options;

use Lib\Forms\Element\FileUploader\Options;
use Phalcon\Mvc\User\Component;

class Ajax extends Component
{
    /** @var Options $options */
    protected $options;

    const TYPE_POST = 'POST';
    const TYPE_PUT = 'PUT';
    const TYPE_PATCH = 'PATCH';

    public function __construct($options)
    {
        $this->options = $options;
        $this->options->fileUploader->storageOptions['url'] = $this->url->get($this->router->getRewriteUri());
    }

    public function setUrl($url)
    {
        $this->options->fileUploader->storageOptions['url'] = $url;
        return $this;
    }

    public function getUrl()
    {
        if(isset($this->options->fileUploader->storageOptions['url']))
        {
            return $this->options->fileUploader->storageOptions['url'];
        }
        return null;
    }

    public function setType($type)
    {
        $this->options->fileUploader->storageOptions['type'] = $type;

        return $this;
    }

    public function getType()
    {
        if(isset($this->options->fileUploader->storageOptions['type']))
        {
            return $this->options->fileUploader->storageOptions['type'];
        }
        return self::TYPE_POST;
    }

    /**
     * The type of data that is expected back from the server.
     *
     * Note: The UI version of the File Upload plugin sets this option to "json" by default.
     *
     * @param string $type
     * @return $this
     * @example 'json'
     */
    public function setDataType($type)
    {
        $this->options->fileUploader->storageOptions['dataType'] = $type;
        return $this;
    }

    public function getDataType()
    {
        if(isset($this->options->fileUploader->storageOptions['dataType']))
        {
            return $this->options->fileUploader->storageOptions['dataType'];
        }
        return 'json';
    }


}