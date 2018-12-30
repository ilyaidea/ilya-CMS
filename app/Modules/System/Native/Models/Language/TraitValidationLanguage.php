<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 12/30/2018
 * Time: 10:34 AM
 */

namespace Modules\System\Native\Models\Language;

use Lib\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;

trait TraitValidationLanguage
{
    public function validation()
    {
        $validator = new Validation();

        /**
         * ISO
         */
        $validator->add( 'iso', new Uniqueness( [
            'model'   => new ModelLanguage(),
            'message' => 'The inputted ISO language is existing'
        ] ) );
        $validator->add( 'iso', new PresenceOf( [
            'model'   => new ModelLanguage(),
            'message' => 'ISO is required'
        ] ) );

        /**
         * Name
         */
        $validator->add('title', new Uniqueness([
            'model' => new ModelLanguage(),
            "message" => "The inputted title is existing"
        ]));
        $validator->add('title', new PresenceOf([
            'model' => new ModelLanguage(),
            'message' => 'Name is required'
        ]));

        return $this->validate($validator);
    }

}