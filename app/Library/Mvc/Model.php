<?php
/**
 * Summary File Model
 *
 * Description File Model
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/11/2018
 * Time: 6:09 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc;

use Lib\Mvc\Model\TraitSetPosition;


/**
 * @property Helper $helper
 */
class Model extends \Phalcon\Mvc\Model
{
    use TraitSetPosition;

    protected $helper;
    protected $update_mode = false;
    protected $create_mode = false;
    protected $dbRef = false;

    public function initialize()
    {
        if(method_exists($this,'init'))
            $this->init();

        if($this->getDI()->getShared('config')->database->dbname)
            $this->setSchema($this->getDI()->getShared('config')->database->dbname);

        if(method_exists($this,'relations'))
            $this->relations();

        $this->helper = $this->getDI()->getShared('helper');

        if(isset($this->getDI()->getShared('config')->module->database->connection) && !$this->isDbRef() )
        {
            $this->setConnectionService($this->getDI()->getShared('config')->module->database->connection);
            $this->setSchema($this->getDI()->getShared('config')->module->database->dbname);
        }

    }

    /**
     * @return bool
     */
    public function isDbRef()
    {
        return $this->dbRef;
    }

    /**
     * @param bool $dbRef
     */
    public function setDbRef($dbRef)
    {
        $this->dbRef = $dbRef;
    }




}