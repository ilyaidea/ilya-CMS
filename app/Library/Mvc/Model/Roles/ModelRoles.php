<?php
/**
 * Summary File ModelRoles
 *
 * Description File ModelRoles
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 9:47 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Roles;


use Lib\Mvc\Model;

class ModelRoles extends Model
{
    use TModelRolesProperties;
    use TModelRolesRelations;

    public function init()
    {
        $this->setSource('ilya_roles');
        $this->setDbRef(true);
    }

    /**
     * Find all roles except one
     *
     * @param string $except
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function findAllExceptByName( $except)
    {
        return ModelRoles::find([
            'conditions' => 'name <> :name:',
            'bind' => [
                'name' => $except
            ]
        ]);
    }
}