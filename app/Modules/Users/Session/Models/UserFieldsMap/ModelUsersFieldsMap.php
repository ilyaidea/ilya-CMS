<?php
/**
 * Summary File ModelUsersFieldsMap
 *
 * Description File ModelUsersFieldsMap
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:17 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models\UserFieldsMap;



use Lib\Mvc\Model;

class ModelUsersFieldsMap extends Model
{
    use TraitModelUserFieldsMapProperties;
    use TraitModelUserFieldsMapRelations;

    public function getSource ()
    {
        return 'ilya_users_fields_map';
    }
}