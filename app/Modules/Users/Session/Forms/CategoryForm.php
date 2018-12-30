<?php
/**
 * Summary File CategoryForm
 *
 * Description File CategoryForm
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/18/2018
 * Time: 9:00 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Modules\Users\Session\Forms;


use Ilya\Models\Lang;
use Lib\Forms\Form;
use Modules\Users\Session\Models\UserFieldsCategory;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

class CategoryForm extends Form
{
    private $editMode = false;
    private $entity = null;

    public function initialize ( $entity = null, $options = [] )
    {
        $this->entity = $entity;

        if (isset($options['edit']) && $options['edit'] == true)
        {
            $this->editMode = true;
            $this->add(new Hidden('id'));
        }

        $this->addTitle( 'title', $entity );
        $this->addContent( 'content' );
        $this->addLang( 'lang' );
        $this->addPosition( 'position' );
        $this->addCSRF( 'csrf' );
        $this->addSubmit( 'Submit' );
    }

    protected function addTitle ( $nameElem, UserFieldsCategory $entity )
    {
        $title = new Text( $nameElem );
        $title->setLabel('Title');

        if ($this->editMode)
        {
            $title->setDefault($entity->title);
        }

        $title->addValidator(
            new PresenceOf(
                [
                    'message' => ':field is required'
                ]
            )
        );
        $this->add( $title );
    }

    protected function addContent ( $nameElem )
    {
        $content = new TextArea( $nameElem, [
            'rows' => 4
        ] );
        $content->setLabel('Content');

        $this->add( $content );
    }

    protected function addLang ( $nameElem)
    {
        $languages = Lang::find( [
            'columns'   => 'id, title',
            'order'     => 'is_primary DESC',
            'hydration' => Resultset::HYDRATE_ARRAYS
        ] )->toArray();


        $selectLangResult = array_column( $languages, 'title', 'id' );
//        die(print_r($selectLangResult));


        $lang = new Select( 'lang', $selectLangResult);
        if ($this->editMode && $this->entity)
        {
            $lang->setDefault($this->entity->lang_id);
        }
        $lang->setLabel('ModelLanguage');

        $lang->addValidator(
            new InclusionIn(
                [
                    'message' => 'The value is not language',
                    'domain' => array_column($languages, 'id')
                ]
            )
        );

        $this->add( $lang );
    }

    protected function addPosition ( $nameElem )
    {
        $position = new Text($nameElem);
        $position->setLabel('Position');

        $position->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ':field is required'
                    ]
                ),
                new Numericality(
                    [
                        'message' => ':field is not numeric'
                    ]
                )
            ]
        );

        $this->add($position);
    }

    protected function addCSRF ( $nameElem )
    {
        $csrf = new Hidden( $nameElem );

        $csrf->addValidator(
            new Identical(
                [
                    'value'   => $this->security->getSessionToken(),
                    'message' => ':field validation failed'
                ]
            )
        );
        $csrf->clear();
        $this->add($csrf);
    }

    protected function addSubmit ( $nameElem )
    {
        $submit = new Submit( $nameElem );

        $this->add( $submit );
    }
}