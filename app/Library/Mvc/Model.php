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
use Phalcon\Mvc\Model\Manager;

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

    public function initialize()
    {
        $this->helper = $this->getDI()->getShared('helper');

        if(isset($this->getDI()->getShared('config')->module->database->connection))
        {
            $this->setConnectionService($this->getDI()->getShared('config')->module->database->connection);
        }

        if(method_exists($this,'init'))
            $this->init();

        if(method_exists($this,'relations'))
            $this->relations();
    }

}