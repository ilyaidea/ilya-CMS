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


trait TModelUsersEvents
{
    public function beforeSave()
    {
        $this->getCreatedAt(date('Y-m-d H:m:s'));
    }
}