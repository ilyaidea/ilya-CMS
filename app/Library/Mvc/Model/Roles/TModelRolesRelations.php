<?php
/**
 * Summary File TModelRolesRelations
 *
 * Description File TModelRolesRelations
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 11:01 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Roles;


use Lib\Mvc\Model\Resources\ModelResources;
use Lib\Mvc\Model\Users\ModelUsers;
use Lib\Mvc\Model\UsersRolesMap\ModelUsersRolesMap;

trait TModelRolesRelations
{
    public function relations()
    {
        $this->belongsTo(
            'parent_id',
            self::class,
            'id',
            [
                'alias' => 'Parent'
            ]
        );

        $this->hasMany(
            'id',
            self::class,
            'parent_id',
            [
                'alias' => 'Childs'
            ]
        );

        $this->hasMany(
            'id',
            ModelResources::class,
            'role_id',
            [
                'alias' => 'Resources'
            ]
        );

        $this->hasManyToMany(
            'id',
            ModelUsersRolesMap::class,
            'role_id', 'user_id',
            ModelUsers::class,
            'id',
            [
                'alias' => 'Users'
            ]
        );
    }
}