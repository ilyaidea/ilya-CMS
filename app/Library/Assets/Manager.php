<?php
/**
 * Summary File Manager
 *
 * Description File Manager
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/23/2018
 * Time: 4:27 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Assets;


use Lib\Mvc\Helper\CmsCache;

class Manager extends \Phalcon\Assets\Manager
{
//    public function finalOutputCss($key)
//    {
////        $sumFileSize = 0;
////        foreach($this->getCss() as $css)
////        {
////            if($css->getLocal())
////            {
////                $sumFileSize += filesize($css->getPath());
////            }
////        }
////
////        $len = strlen('  '.$this->outputInlineCss());
////        $sumFileSize += $len;
//
//        return $this->outputCss($key);
//    }
//
//    public function finalOutputJs($key)
//    {
//        return 'lll';
//    }

    function curl_get_file_size( $url ) {
        // Assume failure.
        $result = -1;

        $curl = curl_init( $url );

        // Issue a HEAD request and follow any redirects.
        curl_setopt( $curl, CURLOPT_NOBODY, true );
        curl_setopt( $curl, CURLOPT_HEADER, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );

        $data = curl_exec( $curl );
        curl_close( $curl );

        if( $data ) {
            $content_length = "unknown";
            $status = "unknown";

            if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
                $status = (int)$matches[1];
            }

            if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
                $content_length = (int)$matches[1];
            }

            // http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            if( $status == 200 || ($status > 300 && $status <= 308) ) {
                $result = $content_length;
            }
        }

        return $result;
    }

    function remote_filesize($url) {
        static $regex = '/^Content-Length: *+\K\d++$/im';
        if (!$fp = @fopen($url, 'rb')) {
            return false;
        }
        if (
            isset($http_response_header) &&
            preg_match($regex, implode("\n", $http_response_header), $matches)
        ) {
            return (int)$matches[0];
        }
        return strlen(stream_get_contents($fp));
    }
}