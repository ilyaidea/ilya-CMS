<?php
/**
 * Summary File CmsCache
 *
 * Description File CmsCache
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/18/2018
 * Time: 7:01 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper;


use Phalcon\Mvc\User\Component;

class CmsCache extends Component
{
    private static $instance = null;

    const DIR_CACHE = BASE_PATH.'data/cache/cms/';

    public static function getInstance ()
    {
        // if the folder does not exist => create it
        if ( !file_exists( self::DIR_CACHE ) )
        {
            mkdir( self::DIR_CACHE, 0777, true );
        }

        if ( !self::$instance )
            return new CmsCache();

        return self::$instance;
    }

    public function has ( $key )
    {
        if ( is_file( $this->file( $key ) ) )
            return true;
    }

    public function get ( $key )
    {
        $file = $this->file( $key );
        if ( is_file( $file ) )
            return json_decode( file_get_contents( $file ), true );
    }

    /*
     * receive the name of json file & an array of data
     */
    public function save ( $key, $data )
    {
        try
        {
            /*
             * This function writes data to a file & returns the number of bytes that were written to the file
             */
            file_put_contents( $this->file( $key ), json_encode( $data ) );
        }
        catch ( \Exception $exception )
        {
            $this->flash->error( $exception->getMessage() );
        }

        return self::getInstance();

    }

    /*
     * create file name like BASE_PATH.'data/cache/cms/translates.json'
     */
    private function file ( $key )
    {
        return self::DIR_CACHE.$key.'.json';
    }
}