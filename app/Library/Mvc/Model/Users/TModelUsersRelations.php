<?php
/**
 * Summary File TModelUsersRelations
 *
 * Description File TModelUsersRelations
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/24/2018
 * Time: 6:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Users;


use Lib\Mvc\Model\Roles\ModelRoles;
use Lib\Mvc\Model\UsersRolesMap\ModelUsersRolesMap;

trait TModelUsersRelations
{
    protected function relations()
    {
        $this->hasManyToMany(
            'id',
            ModelUsersRolesMap::class,
            'user_id', 'role_id',
            ModelRoles::class,
            'id',
            [
                'alias' => 'Roles'
            ]
        );
    }
}