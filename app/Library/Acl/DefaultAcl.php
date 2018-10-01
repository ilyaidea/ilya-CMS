<?php
/**
 * Summary File DefaultAcl
 *
 * Description File DefaultAcl
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 9/29/2018
 * Time: 6:53 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Acl;

use Phalcon\Acl\Role;

class DefaultAcl extends \Phalcon\Acl\Adapter\Memory
{
    private $roles = [];
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultAction(
            \Phalcon\Acl::DENY
        );

        $this->roles['admin'] = new Role('admin', 'Admin role');
        $this->roles['member'] = new Role('member', 'Member role');
        $this->roles['guest'] = new Role('guest', 'Guest role');


        $this->addRole($this->roles['admin']);

        $resources = require_once(APP_PATH. 'config/acl.php');

        foreach($resources as $role => $resource)
        {
            $this->addRole($this->roles[$role]);
            foreach($resource as $key => $value)
            {
                $this->addResource($key, $value);
            }
        }

        $this->allow('admin', '*', '*');

        foreach($resources as $role => $resource)
        {
            foreach($resource as $key => $value)
            {
                $this->allow($role, $key, $value);
            }
        }

    }

    /**
     * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
     * for no arguments provided in isAllowed action if there exists func for accessKey
     *
     * @param int $defaultAccess
     */
    public function setNoArgumentsDefaultAction( $defaultAccess )
    {
        // TODO: Implement setNoArgumentsDefaultAction() method.
    }

    /**
     * Returns the default ACL access level for no arguments provided in
     * isAllowed action if there exists func for accessKey
     *
     * @return int
     */
    public function getNoArgumentsDefaultAction()
    {
        // TODO: Implement getNoArgumentsDefaultAction() method.
    }
}