<?php
/**
 * Summary File TModelResourcesRelations
 *
 * Description File TModelResourcesRelations
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 11:19 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Resources;


use Lib\Mvc\Model\Roles\ModelRoles;

trait TModelResourcesRelations
{
    public function relations()
    {
        $this->belongsTo(
            'role_id',
            ModelRoles::class,
            'id',
            [
                'alias' => 'Role'
            ]
        );
    }
}