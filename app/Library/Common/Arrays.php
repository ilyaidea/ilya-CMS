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

    /**
     * compare 2 arrays and returns an array contains differences
     * in this example, compares translate cache and translate model,
     * and returns an array that does not exist in the database  *
     */
    public static function compareArrays(array $array1 ,array $array2)
    {
        $diff =[];

        foreach ($array1 as $lang => $value)
        {
            if ( isset($array2[$lang])  )
            {
                foreach ($value as $phrase => $translate)
                {
                    if (!array_key_exists($phrase,$array2[$lang]))
                    {
                        $diff[$lang][$phrase] = $translate;
                    }
                }
            }
            else
            {
                $diff[$lang];
            }
        }
        return $diff;
    }
}