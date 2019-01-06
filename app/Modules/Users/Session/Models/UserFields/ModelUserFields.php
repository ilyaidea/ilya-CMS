<?php
/**
 * Summary File ModelUserFields
 *
 * Description File ModelUserFields
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:07 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models\UserFields;

use Lib\Mvc\Model;

class ModelUserFields extends Model
{
    use TraitModelUserFieldsProperties;
    use TraitModelUserFieldsRelations;


    public function getSource ()
    {
        return 'ilya_users_fields';
    }
}