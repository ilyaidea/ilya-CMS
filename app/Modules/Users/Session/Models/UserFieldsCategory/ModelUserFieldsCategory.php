<?php
/**
 * Summary File ModelUserFieldsCategory
 *
 * Description File ModelUserFieldsCategory
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/9/2018
 * Time: 10:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Models\UserFieldsCategory;


use Lib\Mvc\Model;

class ModelUserFieldsCategory extends Model
{
    use TraitModelUserFieldsCategoryProperties;
    use TraitModelUserFieldsCategoryRelations;
    use TraitModelUserFieldsCategoryValidations;

    public function getSource ()
    {
        return 'ilya_users_fields_category';
    }


}