<?php

namespace Modules\System\Native\Forms;

use Lib\Forms\Element\Check;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Modules\System\Native\Models\Language\ModelLanguage;
use Lib\Forms\Element\Select;
use \Lib\Forms\Element\Submit;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class FormLanguage extends Form
{
    public function init()
    {
        $this->formInfo->title->set('add form');
        $this->formInfo->title->appendTag('id','form1');

        $this->addTitle();
        $this->addIso();
        $this->addPosition();
        $this->addIsprimary();
        $this->addDirection();
        $this->addSaveBtn();
    }
    public function addTitle()
    {
        $title = new Text('title',[
                'placeholder' => $this->helper->t('Please enter the language name')
            ]
        );
          $title->setLabel($this->helper->t('Title'));

          $title->setUserOption('note',$this->helper->t('For example: English'));

          if ($this->isEditMode())
          {
              if ($this->getEntity()->title !== $this->request->getPost('title'))
              {
                  $title->addValidator(new Uniqueness([
                      'model' => new ModelLanguage(),
                      'message' => $this->helper->t('The inputted title is existing')
                  ]))  ;
              }
          }
          else
          {
              $title->addValidator(new Uniqueness([
                  'model' => new ModelLanguage(),
                  'message' => $this->helper->t('The inputted title is existing')
              ]))  ;
          }

          $title->addValidator(
                  new PresenceOf( [
                      'message' =>$this->helper->t('the_field_is_required'),
                      'field' => ':field'
                  ]));

          $this->add($title);
    }

    public function addIso()
    {
        $iso = new Text('iso',[
            'placeholder' => $this->helper->t('ModelLanguage code according to standard ISO. For example: en')
        ]);
        $iso->setLabel('ISO');
        $iso->setUserOption('note',$this->helper->t('ModelLanguage code according to standard ISO. For example: en'));
       $iso->addValidators( [
            new PresenceOf( [
                'message' =>$this->helper->t('the_field_is_required'),
                'field' => ':field'
            ]) ,

            new StringLength( [
                'max'            => 5,
                'messageMaximum' => $this->helper->t('The :field must max 5 char')
        ] )]);

        if ($this->isEditMode())
        {
            if ($this->getEntity()->iso !== $this->request->getPost('iso'))
            {
                $iso->addValidator(
                    new Uniqueness([
                    'model' => new ModelLanguage(),
                    'message' => $this->helper->t('The inputted iso is existing')
                ]))  ;
            }
        }
        else
        {
            $iso->addValidator(
                new Uniqueness([
                'model' => new ModelLanguage(),
                'message' => $this->helper->t('The inputted iso is existing')
            ]))  ;
        }
        $this->add($iso);
    }
    public function addPosition()
    {
        $position = new Select('position');
        $position->setOptions( ModelLanguage::positionOptions() );
        $position->setLabel($this->helper->t($this->helper->t('POSITION')));
        $position->addValidators( [
        new Numericality( [
            'message'    => $this->helper->t('The :field is not numeric'),
            'allowEmpty' => true
        ] ),
        new InclusionIn( [
            'domain'  => array_keys( ModelLanguage::positionOptions() ),
            'message' => $this->helper->t('Your input is not within the allowed range')
        ] )
    ] );
        $this->add($position);
    }
    public function addIsprimary()
    {
        $isprimary = new Check('is_primary');
        $isprimary->setDefault(true);
        $isprimary->setUserOption('note',$this->helper->t('This language is chosen as the main language of the site'));
        $isprimary->setLabel($this->helper->t('Is Primary'));
        $isprimary->addValidator(
            new InclusionIn([
                'message' => $this->helper->t('the :field must be true or false'),
                'domain' =>[1 , 0]
            ])
        );
        $this->add($isprimary);

    }
    public function addDirection()
    {
        $direction = new Select('direction');
        $direction->setOptions([
            'rtl' => $this->helper->t('Right to Left'),
            'ltr' => $this->helper->t('Left to Right')
        ]);
        $direction->setLabel($this->helper->t('Direction'));
        $direction->addValidator(
            new InclusionIn(
                [
                    'message' => $this->helper->t('the :field must be rtl or ltr'),
                    'domain'  => [ 'rtl', 'ltr' ]
                ]
            ));
        $this->add($direction);
    }
    public function addSaveBtn()
    {
        $saveBtn = new Submit('save');
        $saveBtn->setLabel($this->helper->t('save'));
        $this->add($saveBtn);
    }
}