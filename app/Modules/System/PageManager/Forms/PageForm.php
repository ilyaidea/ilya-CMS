<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 12/30/2018
 * Time: 11:37 AM
 */
namespace Modules\System\PageManager\Forms;


use Lib\Forms\Element\CkEditor;
use Lib\Forms\Element\Numeric;
use Lib\Forms\Element\Select;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Lib\Mvc\Helper\CmsCache;
use Modules\System\PageManager\Models\Pages\ModelPages;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class PageForm extends Form
{
    public function init()
    {
        $this->formInfo->title->set('Page Form');
        $this->formInfo->title->appendTag('id', 'form_page');
        $this->allowToUpload(true);

        $this->addTitle();
        $this->addSlug();
        $this->addContent();
        $this->addLanguage();
        $this->addPosition();
        $this->addSave();
    }

    public function addTitle()
    {
        $title = new Text( 'title' );
        $title->setLabel( 'Title' );
        $title->setAttributes( ['placeholder' => 'Please enter title',] );

        if($this->isEditMode())
        {
//            dump('ok');
            if($this->getEntity()->title !== $this->request->getPost('title'))
            {
//                dump('ok');
                $title->addValidators(
                    [
                        new Uniqueness(
                            [
                                'model' => new ModelPages(),
                                'message'=> 'The field must be unique'
                            ]
                        ),
                        new PresenceOf(
                            [
                                'message' => 'The field is required',
                                'field' => ':field'
                            ])
                    ]
                );
            }
        }
        else
        {
            $title->addValidators(
                [
                    new Uniqueness(
                        [
                            'model' => new ModelPages(),
                            'message'=> 'The field must be unique'
                        ]
                    ),
                    new PresenceOf(
                        [
                            'message' => 'The field is required',
                            'field' => ':field'
                        ])
                ]
            );
        }
        $this->add( $title );
    }

    public function addSlug()
    {
        $slug = new Text('slug', [
            'placeholder' => 'please enter slug OR empty'
        ]);
        $slug->setLabel(
            $this->helper->t('slug')
        );
        $slug->addValidators([
            new StringLength([
                'max' => 255
            ])
        ]);

        $this->add($slug);
    }

    public function addContent()
    {
        $content = new CkEditor('content');
        $content->setLabel('Content');
        $this->add($content);
    }

    public function addLanguage()
    {

        $language1 = CmsCache::getInstance()->get('languages');
        $lang = array_column($language1,'title','iso');

        $language = new Select('lang', $lang);


        $language-> addValidators([
            new InclusionIn(
                [
                    'message' => "The status must be fa or en or ar",
                    'domain' => array_column($language1,'iso')
                ]
            )

        ]);
        $this-> add($language);
    }

    public function addPosition()
    {
        $position = new Numeric('position');
        $position->setLabel('Position');
        $this->add($position);
    }

    public function addSave()
    {
        $saveBtn = new Submit( 'save' );
        $saveBtn->setLabel( 'Save' );
        $this->add( $saveBtn );
    }
}