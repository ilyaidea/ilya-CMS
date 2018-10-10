<?php
/**
 * Summary File Title
 *
 * Description File Title
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/14/2018
 * Time: 8:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Mvc\Helper;

use Phalcon\Forms\Element;
use Lib\Forms\Form;
use Phalcon\Mvc\User\Component;

class Content extends Component
{
    private static $instance;
    private static $contentList = [];
    private static $formCount = 1;

    private static $currentForm;

    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Content();
        }

        return self::$instance;
    }

    public function form( Form $form = null)
    {
        if ($form instanceof Form)
        {
            $formKey = 'form_'. self::$formCount;

            $errors = self::$instance->getFormErrors($form, $formKey);

            self::$instance->addForm($form, $formKey, $errors);

            self::$formCount += 1;
        }
    }

    public function addForm(Form $form, $formKey, $errors = [])
    {
        if ($form)
        {
            if(!empty($form->getTitle()))
            {
                self::$contentList[$formKey]['title'] = $form->getTitle()['title'];
                self::$contentList[$formKey]['title_tags'] = $this->convertAttrsToTags(@$form->getTitle()['title_tags']);
            }

//            self::$contentList[$formKey]['ok'] = 'form is ok';
//            self::$contentList[$formKey]['error'] = null;
            self::$contentList[$formKey]['tags'] = $this->getTagsForm($form);
            self::$contentList[$formKey]['style'] = (!($form->getStyle())) ? 'tall' : $form->getStyle();

            if(!empty($form->getElements()))
            {
                foreach($form->getElements() as $element)
                {
                    switch($this->getTypeElement($element))
                    {
                        case 'submit':
                            self::$contentList[$formKey]['buttons'][$element->getName()] = $this->setValueButton($element, $errors);
                            break;
                        case 'hidden':
                            self::$contentList[$formKey]['hidden'][$element->getName()] = $this->setElementAsField($element, $errors);
                            break;
                        default:
                            self::$contentList[$formKey]['fields'][$element->getName()] = $this->setElementAsField($element, $errors);
                    }
                }
            }
        }
    }

    public function get($key = null)
    {
        if($key)
        {
            return self::$contentList[$key];
        }
        return self::$contentList;
    }

    public function getForm($key = null)
    {
        if($key)
        {
            return self::$contentList['form_'.$key];
        }

        return self::$contentList;
    }

    public function setElementAsField(Element $element, $errors = [])
    {
        $fields = [];

        if($element->getLabel())
            $fields['label'] = $element->getLabel();

        if(!empty(array_merge($element->getAttributes(), ['name' => $element->getName()])))
        {
            $fields['tags'] = $this->convertAttrsToTags(array_merge($element->getAttributes(), ['name' => $element->getName()]));
        }

        $fields['value'] = (!is_array($element->getValue())) ? $element->getValue() : null;

        $fields['error'] = (isset($errors[$element->getName()])) ? $errors[$element->getName()] : null ;

        $fields['type'] = $this->getTypeElement($element);

        if($this->getTypeElement($element) == 'select')
        {
            foreach($element->getOptions() as $optionKey => $optionVal)
            {
                $fields['options'][$optionKey] = $optionVal;
            }
        }

        if(!empty($element->getUserOptions()))
            foreach($element->getUserOptions() as $optionKey => $optionVal)
            {
                $fields[$optionKey] = $optionVal;
            }

        return $fields;
    }

    private function convertAttrsToTags($attributes)
    {
        $tags = '';

        $countAttrs = count($attributes);
        $i = 0;
        if(is_array($attributes))
        {
            foreach($attributes as $key => $val)
            {
                $i++;

                $tag = $key. '="'. $val. '"';

                if($i != $countAttrs)
                {
                    $tag .= ' ';
                }

                $tags .= $tag;
            }
        }

        return $tags;
    }

    private function getTypeElement($elem)
    {
        return strtolower(substr(get_class($elem), strrpos(get_class($elem), '\\') + 1));
    }

    private function getTagsForm(Form $form)
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

        return $this->convertAttrsToTags($tags);
    }

    private function setValueButton(Element $element, $errors = [])
    {
        $row = [];

        $row['tags'] = $this->convertAttrsToTags($element->getAttributes());
        $row['label'] = $element->getLabel();

        return $row;
    }

    private function getFormErrors(Form $form, $formKey)
    {
        $errors = [];
        if(self::$instance->request->isPost())
        {
            $action = self::$instance->request->getPost('action');

            if(self::$instance->security->checkHash(get_class($form), $action))
            {
                if(!$form->isValid(self::$instance->request->getPost()))
                {
                    self::$contentList[$formKey]['error'] = 'Please fix the following errors';
                    foreach($form->getMessages() as $message)
                    {
                        $errors[$message->getField()] = $message->getMessage();
                        if($message->getField() == 'csrf')
                        {
                            self::$contentList[$formKey]['error'] = 'The form has expired, please try again';
                        }
                    }

                    self::$currentForm['isValid'] = false;
                }
                else
                {
                    self::$currentForm['isValid'] = true;
                }

                self::$currentForm['key'] = $formKey;
                self::$currentForm['className'] = get_class($form);
            }
        }

        return $errors;
    }

    public function getCurrentForm()
    {
        if(self::$currentForm['key'] && $this->request->isPost())
            return array_merge(self::$currentForm, self::$contentList[self::$currentForm['key']]);

        return null;
    }

    public function setFormError($formKey, $errorMessage = null)
    {
        if ($formKey && self::$contentList[$formKey])
        {
            self::$contentList[$formKey]['error'] = $errorMessage;
        }
    }

    public function setFormOk($formKey, $okMessage = null)
    {
        if ($formKey && self::$contentList[$formKey])
        {
            self::$contentList[$formKey]['ok'] = $okMessage;
        }
    }

}