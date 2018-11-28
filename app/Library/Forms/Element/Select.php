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

class Select extends \Phalcon\Forms\Element\Select
{
    /** @var Design $design */
    public $design;
    public function __construct( $name, $options = null, $attributes = null )
    {
        parent::__construct( $name, $options, $attributes );

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
                'type' => 'select'
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