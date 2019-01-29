<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/28/2019
 * Time: 12:52 PM
 */

namespace Lib\Mvc\Forms;


use Lib\Forms\Element\Select;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Lib\Mvc\Model\Roles\ModelRoles;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class ResourcesForm extends Form
{
    public function init()
    {
        $this->formInfo->title->set('resource form');

        $this->addRoleId();
        $this->addControllerName();
        $this->addActionName();
        $this->addSaveBtn();
    }
    public function addRoleId()
    {
        $roleId = new Select('role_id');

        $roleId->setLabel('role');

        $roleId->setOptions(array_column( ModelRoles::find()->toArray(),'name'));
        $roleId->addValidators(
        [
                new PresenceOf(
                [
                    'message' => 'the field is required',
                ]
            ) ,

                new Numericality(
                [
                    'message' => 'the :field must be a number',
                ]
            ),

                new InclusionIn(
                [
                     'domain' =>array_column( ModelRoles::find()->toArray(),'id','id') ,
                     'message' => 'the :field must exist in the role table',
                ]
            )
        ]
        );
        $this->add($roleId);
    }
    public function addControllerName()
    {
        $controller = new Text('controller',[
            'placeholder' => 'Please insert the controller'
        ]);
        $controller->setLabel('controller');
        $controller->addValidators(
        [
            new PresenceOf(
                 [
                     'message' => 'the field is required',
                 ]
            ),

            new StringLength(
                [
                    "max"            => 100,
                    "min"            => 2,
                    "messageMaximum" => "controller name is too long!",
                    "messageMinimum" => "controller name is too short!",
                ]
            )
        ]
        );
        $this->add($controller);
    }
    public function addActionName()
    {
        $action = new Text('actionName',[
            'placeholder' => 'Please insert the action'
        ]);
        $action->setLabel('action');
        $action->addValidators(
        [
            new PresenceOf(
                [
                    'message' => 'the field is required',
                ]
            ),
            new StringLength(
                [
                    "max"            => 20,
                    "min"            => 2,
                    "messageMaximum" => "action name is too long!",
                    "messageMinimum" => "action name is too short!",
                ]
            )
        ]
        );
        $this->add($action);
    }
    public function addSaveBtn()
    {
        $saveBtn = new Submit('save');
        $saveBtn->setLabel($this->helper->t('save'));
        $this->add($saveBtn);
    }

}