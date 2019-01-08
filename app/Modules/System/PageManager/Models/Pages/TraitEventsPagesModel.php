<?php
/**
 * Summary File TraitPropertiesPagesModel
 *
 * Description File TraitPropertiesPagesModel
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/3/2018
 * Time: 5:37 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\System\PageManager\Models\Pages;


trait TraitEventsPagesModel
{
    public function afterCreate()
    {
    }

    public function afterSave()
    {
    }

    public function afterUpdate()
    {
    }

    public function afterValidation()
    {
    }

    public function afterValidationOnCreate()
    {
    }

    public function afterValidationOnUpdate()
    {
    }

    public function beforeValidationOnCreate()
    {
    }

    public function beforeValidationOnUpdate()
    {
    }

    public function onValidationFails()
    {
    }

    public function prepareSave()
    {
    }

    public function beforeValidation()
    {
        if($this->getLanguage() == null)
        {
            $this->setLanguage($this->getDI()->getShared('helper')->locale()->getLanguage());
        }

        if(!$this->getSlug() && $this->getTitle())
        {
            $this->setSlug(str_replace(' ', '-', $this->getTitle()));
        }

    }

    public function beforeCreate()
    {
        $this->create_mode = true;
        $this->setCreatedAt(date('Y-m-d H:i:s'));
    }

    public function beforeUpdate()
    {
        $this->updat_mode = true;
        $this->setModifiedIn(date('Y-m-d H:i:s'));
    }

    public function beforeSave()
    {
        if (!$this->getPosition() || !is_numeric($this->getPosition()))
            $this->setPositionIfEmpty();

        if ($this->getSlug())

            $this->findRoutesBySlug();
    }

}