<?php
namespace Lib;

use Throwable;

class Exception extends \Phalcon\Exception
{
    public function __construct( $message = "", $code = 0, Throwable $previous = null )
    {
        parent::__construct( $message, $code, $previous );
    }
}