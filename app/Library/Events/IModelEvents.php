<?php
/**
 * Summary File IModelEvents
 *
 * Description File IModelEvents
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/3/2018
 * Time: 11:15 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Events;

interface IModelEvents
{
    public function afterCreate();
    public function afterSave();
    public function afterUpdate();
    public function afterValidation();
    public function afterValidationOnCreate();
    public function afterValidationOnUpdate();
    public function beforeCreate();
    public function beforeSave();
    public function beforeUpdate();
    public function beforeValidation();
    public function beforeValidationOnCreate();
    public function beforeValidationOnUpdate();
    public function onValidationFails();
    public function prepareSave();
}