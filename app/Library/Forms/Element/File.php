<?php
/**
 * Summary File Text
 *
 * Description File Text
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/8/2018
 * Time: 9:40 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms\Element;

use Lib\Forms\Design;

class File extends \Phalcon\Forms\Element\File
{
    /** @var Design $design */
    public $design;
    public function __construct( $name, array $attributes = null )
    {
        parent::__construct( $name, $attributes );

        $this->design = new Design($this);
    }

    public function getAttributes()
    {
        $arg = null;
        if(!empty(func_get_args()) && count(func_get_args()) == 1)
        {
            $arg = func_get_args()[0];
        }

        $attrs = parent::getAttributes();

        $attrs = array_merge(
            [
                'type' => 'file'
            ],
            $attrs
        );

        if($arg)
        {
            return (isset($attrs[$arg])) ? $attrs[$arg] : null;
        }

        return $attrs;
    }
}