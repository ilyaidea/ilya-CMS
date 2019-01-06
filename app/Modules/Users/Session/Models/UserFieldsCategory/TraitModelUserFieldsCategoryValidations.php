<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/06/2019
 * Time: 11:45 AM
 */

namespace Modules\Users\Session\Models\UserFieldsCategory;


use Modules\Others\Course\Lib\Validations\BaseValidation;

trait TraitModelUserFieldsCategoryValidations
{
    public function validation ()
    {
        $validator = new BaseValidation(null,$this);

        $validator->validationTitle();

        return $this->validate($validator);
    }

}