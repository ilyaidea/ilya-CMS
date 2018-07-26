<?php
/**
 * Summary File Users
 *
 * Description File Users
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 6/30/2018
 * Time: 6:17 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Ilya\Models;

class Users extends \Phalcon\Mvc\Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $created;
    public $active;

    public function initialize()
    {
        $this->setSource('users');
    }
}