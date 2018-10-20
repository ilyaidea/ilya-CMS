<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/12/2018
 * Time: 1:50 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms;

use Lib\Forms\Element\Hidden;
use Phalcon\Security;
use Phalcon\Validation\Validator\Identical;

class Form extends \Phalcon\Forms\Form implements IForm
{
    private $titleInfo = [];
    private $token;

    /**
     * @var Hidden $id
     */
    protected $id;
    protected $entity;
    protected $editMode;

    public function __construct ( $entity = null, array $userOptions = null )
    {
        parent::__construct( $entity, $userOptions );

        $action = new Hidden('action', [
            'value' => $this->security->hash(get_class($this))
        ]);
        $this->add($action);

        $csrf = new Hidden('csrf', [
            'value' => $this->getToken()
        ]);
        $csrf->addValidator(
            new Identical(
                [
                    'value' => $this->security->getSessionToken(),
                    'message' => ':field validation failed'
                ]
            )
        );
        $csrf->clear();
        $this->add($csrf);
    }

    public function initialize($entity = null, $options = [])
    {
        $this->entity = $entity;
        if(isset($options['edit']) && isset($entity))
        {
            $this->setTitleForm('Edit Language Form');
            $this->id = new Hidden('id');

            $this->editMode = true;
        }
        else
        {
            $this->setTitleForm('Add Language Form');
        }

        $this->initElements();
        $this->setAttributesElements();
        $this->setDefaultElements();
        $this->setOptionsElements();
        $this->setUserOptionsElements();
        $this->setLabelElements();
        $this->validationElements();
        $this->addElements();
    }

    public function setTitleForm($title, $tags = [])
    {
        if($title)
        {
            $this->titleInfo['title'] = $title;

            if(!empty($tags))
            {
                $this->titleInfo['title_tags'] = $tags;
            }
        }
    }

    public function getTitleForm()
    {
        return @$this->titleInfo['title'];
    }
    public function getTitleTags()
    {
        return @$this->titleInfo['title_tags'];
    }

    public function getToken()
    {
        if(!$this->security->getSessionToken())
        {
            return $this->security->getToken();
        }
        else
        {
            return $this->security->getSessionToken();
        }
    }

    public function initElements()
    {

    }

    public function setAttributesElements()
    {
        if( $this->editMode )
            $this->id->setAttributes( [
                'value' => $this->entity->id
            ] );
    }

    public function setDefaultElements()
    {
        // TODO: Implement setDefaultElements() method.
    }

    public function setOptionsElements()
    {
        // TODO: Implement setOptionsElements() method.
    }

    public function setUserOptionsElements()
    {
        // TODO: Implement setUserOptionsElements() method.
    }

    public function setLabelElements()
    {
        // TODO: Implement setLabelElements() method.
    }

    public function validationElements()
    {
        // TODO: Implement validationElements() method.
    }

    public function addElements()
    {
        if( $this->editMode )
            $this->add( $this->id );
    }
}