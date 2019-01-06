<?php

namespace Modules\System\Native\Forms;

use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;

class FormTranslate extends Form
{
    public function init()
    {
        $this->formInfo->title->set($this->helper->t('add form'));
        $this->formInfo->title->appendTag('id','form1');

        $this->addPhrase();
        $this->addTranslation();
        $this->addSaveBtn();
    }

    public function addPhrase()
    {
        $phrase = new Text('phrase',[
            'placeholder' => $this->helper->t('Please enter the phrase')
        ]);
        $phrase->setUserOption('note',$this->helper->t('For example: hi_name'));
        $phrase->setLabel($this->helper->t('Phrase'));
        $phrase->addValidator(
            new PresenceOf( [
                'message' => $this->helper->t('The :field is required')
            ])
        );
        $this->add($phrase);
    }

    public function addTranslation()
    {
        $translation = new TextArea('translation',[
                'placeholder' => $this->helper->t('Please enter the translation')
            ]  );
          $translation->setLabel(
              $this->helper->t('Translation')
          );
          $translation->setUserOption('note',$this->helper->t('For example: Hi %name%'));
          $this->add($translation);
    }

    public function addSaveBtn()
    {
        $saveBtn = new Submit('save');
        $saveBtn->setLabel($this->helper->t('SAVE'));
        $this->add($saveBtn);

    }
}