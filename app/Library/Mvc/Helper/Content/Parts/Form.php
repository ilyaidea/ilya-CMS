<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 3:59 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Helper\Content\Parts;

use Lib\Common\Arrays;
use Phalcon\Forms\Element;

class Form extends AbstractForm
{
    protected $form;
    protected $formKey;
    private $style = 'tall';
    private $fields = [];
    private $extra = [];
    private $buttons = [];
    private $hiddens = [];
    private $errors = [];
    protected $error;
    private $ok;

    public function __construct(\Lib\Forms\Form $form, $formKey = null)
    {
        $this->form = $form;
        $this->formKey = $formKey;

        $this->validation();
        $this->init();
    }

    private function validation()
    {
        if(!$this->form->request->isPost())
        {
            return;
        }

        $postData = $this->form->request->getPost();
        $action = @$postData['action'];

//        die(print_r(get_class($action)));
        if($this->form->security->checkHash(get_class($this->form), $action))
        {
            if(!$this->form->isValid($postData))
            {
                $this->error = 'Please fix the following errors';

                foreach($this->form->getMessages() as $message)
                {
                    $this->errors[$message->getField()] = $message->getMessage();

                    if($message->getField() == 'csrf')
                        $this->error = 'The form has expired, please try again';
                }

                $this->extra['isValid'] = false;
            }
            else
            {
                $this->extra['isValid'] = true;
            }

        }
    }

    private function init()
    {
        /** @var Element $element */
        foreach($this->form->getElements() as $element)
        {
            $this->setField($element);
            $this->setButton($element);
            $this->setHidden($element);
        }
    }

    private function setField(Element $element)
    {
        if($this->getElementType($element) !== 'hidden' && $this->getElementType($element) !== 'submit')
        {
            $field = [
                'label' => @$element->getLabel(),
                'tags' => Arrays::arrayToStringTags(
                    array_merge($element->getAttributes(),
                        ['name' => $element->getName()])
                ),
                'value' => (!is_array($element->getValue())) ? $element->getValue() : null,
                'error' => (isset($this->errors[$element->getName()])) ? $this->errors[$element->getName()] : null,
                'type' => $this->getElementType($element)
            ];

            if($this->getElementType($element) === 'select')
            {
                $field['match_by'] = 'key';
                foreach($element->getOptions() as $optionKey => $optionVal)
                {
                    $field['options'][$optionKey] = $optionVal;
                }
            }

            if(!empty($element->getUserOptions()))
                foreach($element->getUserOptions() as $keyOption => $option)
                {
                    $field[$keyOption] = $option;
                }

            $this->fields[$element->getName()] = $field;
        }
    }

    private function setHidden(Element $element)
    {
        if($this->getElementType($element) == 'hidden')
        {
            $hidden = [
                'tags' => Arrays::arrayToStringTags(
                    array_merge($element->getAttributes(),
                        ['name' => $element->getName()])
                ),
                'value' => (!is_array($element->getValue())) ? $element->getValue() : null,
                'error' => (isset($this->errors[$element->getName()])) ? $this->errors[$element->getName()] : null,
                'type' => $this->getElementType($element)
            ];

            $this->hiddens[$element->getName()] = $hidden;
        }
    }

    private function setButton(Element $element)
    {
        if($this->getElementType($element) == 'submit')
        {
            $button = [
                'label' => @$element->getLabel(),
                'tags' => Arrays::arrayToStringTags($element->getAttributes()),
            ];

            $this->buttons[$element->getName()] = $button;
        }
    }

    public function toArray()
    {
        $formResult = [];

        $formResult['style'] = $this->style;

        $formResult['ok'] = $this->ok;

        $formResult['error'] = $this->error;

        $formResult['title'] = @$this->form->getTitleForm();

        $formResult['title_tags'] = Arrays::arrayToStringTags(@$this->form->getTitleTags());

        $formResult['tags'] = $this->getTagsForm($this->form);

        if(!empty($this->fields))
        {
            $formResult['fields'] = $this->fields;
        }

        if(!empty($this->buttons))
        {
            $formResult['buttons'] = $this->buttons;
        }

        if(!empty($this->hiddens))
        {
            $formResult['hidden'] = $this->hiddens;
        }

        $formResult = array_merge($this->extra, $formResult);

        return $formResult;
    }

    private function getTagsForm(\Lib\Forms\Form $form)
    {
        $tags = [];
        if($form->getAction())
        {
            $tags['action'] = $form->getAction();
        }
        if(!$form->getUserOption('method'))
        {
            $tags['method'] = 'post';
        }

        $tags = array_merge($form->getUserOptions(), $tags);

        return Arrays::arrayToStringTags($tags);
    }

    public function isValid()
    {
        if($this->form->request->isPost() && isset($this->extra['isValid']) && $this->extra['isValid'] == true)
        {
            return true;
        }
    }

    public function setError($error = null)
    {
        $this->error = $error;

        $this->form->helper->content()->getContent()->setParts(
            $this->formKey,
            $this->toArray()
        );
    }

    public function setOk($okMessage = null)
    {
        $this->ok = $okMessage;

        $this->form->helper->content()->getContent()->setParts(
            $this->formKey,
            $this->toArray()
        );
    }
}