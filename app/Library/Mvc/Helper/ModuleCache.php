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


use Phalcon\Di;
use Phalcon\Mvc\User\Component;

class ModuleCache extends Component
{
    private static $instance;

    private static $dir_cache;

    public static function getInstance ()
    {
        self::$dir_cache = Di::getDefault()->getShared('config')->module->path. '/data/cache/module/';

        // if dont exist folder => create
        if ( !file_exists( self::$dir_cache ) )
        {
            mkdir( self::$dir_cache, 0777, true );
        }

        if ( !self::$instance )
            return new ModuleCache();

        return self::$instance;
    }

    public function has ( $key )
    {
        if ( is_file( $this->file( $key ) ) )
            return true;

        return false;
    }

    public function get ( $key )
    {
        $file = $this->file( $key );
        if ( is_file( $file ) )
            return json_decode( file_get_contents( $file ), true );

        return null;
    }

    public function save ( $key, $data )
    {
        try
        {
            file_put_contents( $this->file( $key ), json_encode( $data ) );
        }
        catch ( \Exception $exception )
        {
            $this->flash->error( $exception->getMessage() );
        }

        return self::getInstance();

    }

    private function file ( $key )
    {
        return self::$dir_cache.$key.'.json';
    }
}