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
        // TODO: Implement afterCreate() method.
    }

    public function afterSave()
    {
        // TODO: Implement afterSave() method.
    }

    public function afterUpdate()
    {
        // TODO: Implement afterUpdate() method.
    }

    public function afterValidation()
    {
        // TODO: Implement afterValidation() method.
    }

    public function afterValidationOnCreate()
    {
        // TODO: Implement afterValidationOnCreate() method.
    }

    public function afterValidationOnUpdate()
    {
        // TODO: Implement afterValidationOnUpdate() method.
    }

    public function beforeCreate()
    {
        $this->setCreatedAt(date('Y-m-d H:i:s'));
    }

    public function beforeSave()
    {
        if(!$this->getPosition())
        {
            $this->setPositionIfNull();
        }
    }

    public function beforeUpdate()
    {
        $this->setModifiedIn(date('Y-m-d H:i:s'));
    }

    public function beforeValidation()
    {
        if($this->getLanguage() == null)
        {
            $this->setLanguage(
                $this->getDI()->getShared('helper')->locale()->getLanguage()
            );
        }
    }

    public function beforeValidationOnCreate()
    {
        // TODO: Implement beforeValidationOnCreate() method.
    }

    public function beforeValidationOnUpdate()
    {
        // TODO: Implement beforeValidationOnUpdate() method.
    }

    public function onValidationFails()
    {
        // TODO: Implement onValidationFails() method.
    }

    public function prepareSave()
    {
        // TODO: Implement prepareSave() method.
    }

    private function setPositionIfNull()
    {
        $lastPosition = null;
        if($this->getParentId() == null)
        {
            $lastPosition = self::findFirst([
                'conditions' => 'parent_id IS NULL AND language = :lang:',
                'order' => 'position DESC',
                'bind' => [
                    'lang' => $this->getLanguage()
                ]
            ]);
        }
        else
        {
            $lastPosition = self::findFirst([
                'conditions' => 'parent_id = :parent: AND language = :lang:',
                'order' => 'position DESC',
                'bind' => [
                    'parent' => $this->getParentId(),
                    'lang' => $this->getLanguage()
                ]
            ]);
        }

        if($lastPosition && $lastPosition->position && is_numeric($lastPosition->position))
        {
            return $this->setPosition($lastPosition->position + 1);
        }

        return $this->setPosition(1);
    }
}