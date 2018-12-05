<?php
/**
 * Summary File Strings
 *
 * Description File Strings
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/13/2018
 * Time: 9:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Common;

class Arrays
{
    /**
     * @param array $array
     * @return null|string
     * @example
     *    Desc
     *    <code>
     * ```php
     * $array = [
     *    'id' => 'id-elem',
     *    'class' => 'class-elem'
     * ];
     * Lib\Common\Arrays::arrayToStringTags( $array )
     * ```
     *    </code>
     */
    public static function arrayToStringTags(array $array )
    {
        $attrs = '';
        if(is_array($array) && !empty($array))
        {
            $count = count($array);
            $i = 1;

            foreach($array as $key => $value)
            {
                $attrs .= " $key='$value'";

                if($i !== $count)
                {
                    $attrs .= ' ';
                }
                $i++;
            }
        }

        return $attrs;
    }
}