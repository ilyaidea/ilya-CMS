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
use Lib\Forms\Element;
use Lib\Tag;

class Submit extends Element
{
    /** @var Design $design */
    public $design;
    public function __construct( $name, array $attributes = null )
    {
        parent::__construct( $name, $attributes );
        $this->_type = 'submit';

        $this->design = new Design($this);
    }

    public function render( $attributes = null )
    {
        return Tag::submitButton($this->prepareAttributes($attributes));
    }
}