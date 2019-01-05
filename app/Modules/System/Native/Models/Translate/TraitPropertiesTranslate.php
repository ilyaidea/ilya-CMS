<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 12/31/2018
 * Time: 8:30 AM
 */

namespace Modules\System\Native\Models\Translate;


trait TraitPropertiesTranslate
{
    private $id;
    private $language;
    private $phrase;
    private $translation;

    public function getId()
    {
        return $this->id;
    }
    public function getLanguage()
    {
        return $this->language;
    }
    public function setLanguage( $language )
    {
        $this->language = $language;
    }
    public function getPhrase()
    {
        return $this->phrase;
    }
    public function setPhrase( $phrase )
    {
        $this->phrase = \Phalcon\Text::underscore($phrase);
    }
    public function getTranslation()
    {
        return $this->translation;
    }
    public function setTranslation( $translation )
    {
        $this->translation = $translation;
    }
}