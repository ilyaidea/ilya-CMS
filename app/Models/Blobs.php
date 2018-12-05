<?php
/**
 * Summary File Blobs
 *
 * Description File Blobs
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/3/2018
 * Time: 6:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Ilya\Models;

use Lib\Mvc\Model;

class Blobs extends Model
{
    public $id;             // Big int 20 / unsigned / not null /
    public $format;         // Varchar 20 / not null
    public $content;        // Mediumblob / is null default
    public $name;           // Varchar 255 / is null default
    public $size;           // Varchar 100 / is null default
    public $user_id;        // int 10 / unsigned / is null default
    public $cookie_id;      // Big int 20 / unsigned / is null default
    public $create_ip;      // Varbinary 16 / is null default
    public $created;        // datetime / is null default
    public $status;         // enum ('tmp', 'active') / not null

    public function initialize()
    {
//        parent::initialize();
        $this->setSource('ilya_blobs');
    }

    public function beforeCreate()
    {
        $this->setCreated(date('Y-m-d H:i:s'));
    }

    public function beforeValidationOnCreate()
    {
        $this->setId();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId()
    {
        for ($attempt = 0; $attempt < 10; $attempt++) {
            $blobId = sprintf('%d%06d%06d', mt_rand(1, 18446743), mt_rand(0, 999999), mt_rand(0, 999999));

            if (self::findFirst($blobId))
                continue;

            $this->id = $blobId;
        }
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat( $format )
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent( $content )
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $file_name
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize( $size )
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId( $user_id )
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getCookieId()
    {
        return $this->cookie_id;
    }

    /**
     * @param mixed $cookie_id
     */
    public function setCookieId( $cookie_id )
    {
        $this->cookie_id = $cookie_id;
    }

    /**
     * @return mixed
     */
    public function getCreateIp()
    {
        return $this->create_ip;
    }

    /**
     * @param mixed $create_ip
     */
    public function setCreateIp( $create_ip )
    {
        $this->create_ip = $create_ip;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated( $created )
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus( $status )
    {
        $this->status = $status;
    }
}