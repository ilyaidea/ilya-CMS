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


use Lib\Validation;
use Modules\System\Native\Models\Language;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;

trait TraitValidationsPagesModel
{
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'title',
            new PresenceOf([
                'message' => 'this :field is required'
            ])
        );
        $validator->add(
            'title',
            new Uniqueness([
                'model' => new ModelPages(),
                'message' => 'title must be unique'
            ])
        );

        // Language
        $validator->add(
            'language',
            new InclusionIn([
                'domain' => array_column(Language::findCachedLanguages(), 'iso'),
                'message' => 'language is not in domain'
            ])
        );

        // parent id
        $validator->add(
            'parent_id',
            new InclusionIn([
                'domain' => self::findAllParentsByLang($this->getLanguage()),
                'message' => 'parent id is not in domain',
                'allowEmpty' => true
            ])
        );

        // Position
        $validator->add(
            'position',
            new Numericality([
                'message' => 'the :field must be numeric',
                'allowEmpty' => true
            ])
        );

        return $this->validate($validator);
    }
}