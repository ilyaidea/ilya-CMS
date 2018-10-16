<?php
/**
 * Summary File Column
 *
 * Description File Column
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/16/2018
 * Time: 8:56 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Db;

class Column extends \Phalcon\Db\Column
{
    protected $_rename;

    public function __construct( $name, array $definition )
    {
        parent::__construct( $name, $definition );

        if(isset($definition['rename']))
        {
            $this->_rename = $definition['rename'];
        }
    }

    /**
     * @return mixed
     */
    public function getRename()
    {
        return $this->_rename;
    }


}