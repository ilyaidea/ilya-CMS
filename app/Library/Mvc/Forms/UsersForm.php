<?php
/**
 * Created by PhpStorm.
 * User: Webhouse
 * Date: 1/28/2019
 * Time: 11:56 AM
 */

namespace Lib\Mvc\Forms;


use Lib\Forms\Element\Email;
use Lib\Forms\Element\Submit;
use Lib\Forms\Element\Text;
use Lib\Forms\Form;
use Lib\Mvc\Model\Users\ModelUsers;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;

class UsersForm extends Form
{
    public function init()
    {
       $this->formInfo->title->set('user Form');

        $this->addUsername();
        $this->addEmail();
        $this->addSaveBtn();

    }

    public function addUsername()
    {
        $username = new Text('username',[
            'placeholder' => $this->helper->t('Please insert the username')
        ]);

        $username->setLabel( $this->helper->t('username') );

        $username->addValidators(
            [
                new PresenceOf(
                [
                    'message' => $this->helper->t('the :field is required')
                ]
                ),
                new Uniqueness(
                    [
                    'model' => new ModelUsers(),
                    'message' => $this->helper->t('The inputted :field is existing')
                     ]
                ),
                new StringLength(
                [
                    "max"            => 20,
                    "min"            => 2,
                    "messageMaximum" => $this->helper->t(":field is too long!"),
                    "messageMinimum" => $this->helper->t("field is too short!")
                ]
                )

            ]
        );
        $this->add($username);
    }

    public function addEmail()
    {
        $email = new Text('email',[
            'placeholder' => $this->helper->t('Please insert the email')
        ]);

        $email->setLabel( $this->helper->t('email') );

        $email->addValidators(
            [
                    new PresenceOf(
                    [
                        'message' => $this->helper->t('the :field is required')
                    ]
                    ),
//                    new Email(
//                  [
//                        'massage' => 'The e-mail is not valid',
//                  ]
//                  )
            ]
             );
        $this->add($email);
    }

    public function addSaveBtn()
    {
        $saveBtn = new Submit('save');
        $saveBtn->setLabel($this->helper->t('save'));
        $this->add($saveBtn);

    }
}