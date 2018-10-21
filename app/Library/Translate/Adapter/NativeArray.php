<?php
/**
 * Summary File NativeArray
 *
 * Description File NativeArray
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/21/2018
 * Time: 8:18 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Translate\Adapter;

class NativeArray extends \Phalcon\Translate\Adapter\NativeArray
{
    public function query( $index, $placeholders = null )
    {
        $translation = parent::query( $index, $placeholders );

        if(!$translation)
            return $index;

        return $translation;
    }
}