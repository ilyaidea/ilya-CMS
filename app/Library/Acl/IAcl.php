<?php
namespace Lib\Acl;


interface IAcl
{
    /**
     * The task is to add Controllers Array to resources for ACL
     *
     * @param array $controllers
     */
    public function addResourcesForControllerClass($controllers);

    /**
     * Add Roles And Allow
     * @param string $namespace
     */
    public function addRolesAndAllow($namespace);
}