<?php
/**
 * Summary File Color
 *
 * Description File Color
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/1/2018
 * Time: 9:46 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms\Element;


use Lib\Forms\Element;
use Lib\Tag;

class DateTime extends Element
{
    public function __construct( $name, array $attributes = null )
    {
        parent::__construct( $name, $attributes );
        $this->_type = 'datetime';
    }

    public function render( $attributes = null )
    {
        return Tag::dateTimeField($this->prepareAttributes($attributes));
    }
}