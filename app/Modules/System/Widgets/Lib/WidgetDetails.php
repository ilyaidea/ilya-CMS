<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/07/2019
 * Time: 12:29 PM
 */

namespace Modules\System\Widgets\Lib;

use Lib\Common\UtilMetaData;

class WidgetDetails
{
    //get metadata in widget

    public static function  WidgetList()
    {
        try {
            $row = self::getPath_Namespace();

            $util = new UtilMetaData();
            if (empty($row)) {
                throw new \Exception("Widgets not exist");
            }

            $array = [];
            foreach ($row as $widget)
            {
//                if (!empty($metadata))
//                {
////                    $metadata = $util->fetchFromAddonPath($widget['path']);
//                }
                $content = file_get_contents($widget['path']);
                $metadata = $util->addonMetadata($content, "Widget");

                $array[] = $metadata;
            }
            return ($array);

        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }
    }

    // get path & namespace

    public static function getPath_Namespace()
    {
        $dir = glob(MODULE_PATH . "**/**/Widgets/*.php");
        $row = [];
        foreach ($dir as $path) {
            $replace   = str_replace("/", "\\", $path);
            $replace1  = str_replace(".php", "", $replace);
            $namespace = explode("app", $replace1);
            $row[] = [
                "namespace" => $namespace[1],
                "path" => $path
            ];
        }
        return $row;
    }

}