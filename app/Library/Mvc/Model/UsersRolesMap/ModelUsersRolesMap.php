<?php
/**
 * Summary File ModelUsersRolesMap
 *
 * Description File ModelUsersRolesMap
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 11:11 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\UsersRolesMap;


use Lib\Mvc\Model;

class ModelUsersRolesMap extends Model
{
    use TModelUsersRolesMapProperties;
    use TModelUsersRolesMapValidations;

    public function init()
    {
        $this->setSource('ilya_users_roles_map');
        $this->setDbRef(true);
    }
}