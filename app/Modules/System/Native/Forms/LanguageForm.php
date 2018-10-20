<?php

namespace Modules\System\Native\Forms;

use Lib\Forms\Element\Check;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Modules\System\Native\Models\Language;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class LanguageForm extends Form
{
    public function initialize( $entity = null, $options = [] )
    {
        parent::initialize( $entity = null, $options = [] );
    }

    public function initElements()
    {
        parent::initElements();

        $this->title     = new Text( 'title' );
        $this->iso       = new Text( 'iso' );
        $this->isPrimary = new Check( 'is_primary' );
        $this->direction = new Select( 'direction' );
        $this->position  = new Select( 'position' );
        $this->saveBtn   = new Submit( 'save' );
    }

    public function setAttributesElements()
    {
        parent::setAttributesElements();

        $this->title->setAttributes( [
            'placeholder' => 'Please enter the language name'
        ] );

        $this->iso->setAttributes( [
            'placeholder' => 'Language code according to standard ISO. For example: en'
        ] );
    }

    public function setDefaultElements()
    {
        parent::setDefaultElements();

        $this->isPrimary->setDefault( false );
    }

    public function setOptionsElements()
    {
        parent::setOptionsElements();

        $this->direction->setOptions( [
            'rtl' => 'Right to Left',
            'ltr' => 'Left to Right'
        ] );

        $this->position->setOptions( Language::positionOptions() );
    }

    public function setUserOptionsElements()
    {
        parent::setUserOptionsElements();

        $this->title->setUserOptions( [
            'note' => 'For example: English'
        ] );

        $this->iso->setUserOptions( [
            'note' => "Language code according to standard ISO. For example: en"
        ] );

        $this->isPrimary->setUserOptions( [
            'note' => 'This language is chosen as the main language of the site'
        ] );

    }

    public function setLabelElements()
    {
        parent::setLabelElements();

        $this->title->setLabel( 'Title' );
        $this->iso->setLabel( 'Iso' );
        $this->isPrimary->setLabel( 'Is Primary' );
        $this->direction->setLabel( 'Direction' );
        $this->position->setLabel( 'Position' );
        $this->saveBtn->setLabel( 'Save' );
    }

    public function validationElements()
    {
        parent::validationElements();

        $this->title->addValidators( [
            new PresenceOf( [
                'message' => $this->helper->t('the_field_is_required', [
                    'field' => ':field'
                ])
            ] )
        ] );

        $this->iso->addValidators( [
            new PresenceOf( [
                'message' => $this->helper->t('the_field_is_required', [
                    'field' => ':field'
                ])
            ] ),
            new StringLength( [
                'max'            => 5,
                'messageMaximum' => 'The :field must max 5 char'
            ] )
        ] );

        $this->isPrimary->addValidator(
            new InclusionIn( [
                'message' => 'the :field must be true or false',
                    'domain'  => [ false, 1 ]
            ] )
        );

        $this->direction->addValidator(
            new InclusionIn( [
                'message' => 'the :field must be rtl or ltr',
                'domain'  => [ 'rtl', 'ltr' ]
            ] )
        );

        $this->position->addValidators( [
            new Numericality( [
                'message'    => 'The :field is not numeric',
                'allowEmpty' => true
            ] ),
            new InclusionIn( [
                'domain'  => array_keys( Language::positionOptions() ),
                'message' => 'Your input is not within the allowed range'
            ] )
        ] );
    }

    public function addElements()
    {
        parent::addElements();

        $this->add( $this->title );
        $this->add( $this->iso );
        $this->add( $this->isPrimary );
        $this->add( $this->direction );
        $this->add( $this->position );
        $this->add( $this->saveBtn );
    }

    /*
     * Elements
     */
    /**
     * @var Text $title
     */
    private $title;
    /**
     * @var Text $iso
     */
    private $iso;
    /**
     * @var Check $isPrimary
     */
    private $isPrimary;
    /**
     * @var Select $direction
     */
    private $direction;
    /**
     * @var Select $position
     */
    private $position;
    /**
     * @var Submit $saveBtn
     */
    private $saveBtn;
}