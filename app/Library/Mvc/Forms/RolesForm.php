<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/28/2019
 * Time: 10:09 AM
 */
namespace Lib\Mvc\Forms;

use Lib\Forms\Element\Select;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Lib\Mvc\Model\Roles\ModelRoles;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class RolesForm extends Form
{
    public function init()
    {
        $this->formInfo->title->set('role form');

        $this->addName();
        $this->addDescription();
        $this->addParentId();
        $this->addSaveBtn();
    }

    public function addName()
    {
        $name = new Text('name',[
            'placeholder' => $this->helper->t('Please insert the name')
        ]);

        $name->setLabel( $this->helper->t('Name') );

        $name->addValidators(
            [
                new PresenceOf(
                [
                    'message' => $this->helper->t('the :field is required')
                ]
            ),
                new Uniqueness(
                [
                    'model' => new ModelRoles(),
                    'message' => $this->helper->t('The inputted :field is existing')
                ]
            ),
                new StringLength(
                [
                    "max"            => 30,
                    "messageMaximum" => $this->helper->t("name is too long!"),
                ]
            )

        ]
            );
        $this->add($name);
    }
    public function addDescription()
    {
        $description = new Text('description',[
            'placeholder' => $this->helper->t('Please insert the description')
        ]);

        $description->setLabel( $this->helper->t('Description') );

        $description->addValidator(
            new StringLength(
                [
                    "max"            => 200,
                    "messageMaximum" => $this->helper->t("description is too long!"),
                    'allowEmpty' => true,
                ]
            )
        );
        $this->add($description);
    }
    public function addParentId()
    {
        $parentId = new Select('parent_id',[null => 'Select a user...']);

        $parentId->setLabel($this->helper->t('Parent'));

        $parentId->setOptions(
            array_merge([''=>'select one..'],array_column(ModelRoles::find()->toArray(),'name','id'))
        );

        $parentId->addValidator(
           new InclusionIn(
                 [
                  'domain'  => array_column(ModelRoles::find()->toArray(),'id','id'),
                  'message' => $this->helper->t('the parent role must be in the role table'),
                  'allowEmpty' => true,
                 ]
           )
        );
        $this->add($parentId);
    }
    public function addSaveBtn()
    {
        $saveBtn = new Submit('save');
        $saveBtn->setLabel($this->helper->t('save'));
        $this->add($saveBtn);
    }


}