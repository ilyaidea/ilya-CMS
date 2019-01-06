<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 12/30/2018
 * Time: 10:25 AM
 */

namespace Modules\Users\Session\DataTable;

use Lib\DataTables\Ajax;
use Lib\DataTables\DataTable;
use Lib\Mvc\Model\Users\ModelUsers;

class UserDataTable extends DataTable
{
    public function init()
    {
     //  dump(ModelUsers::find()->toArray());

        $this->ajax->setType(Ajax::POST_DATA);

        $this->setTitle('Users');

        $this->disableError();

      //  $this->setTreeView(true);

        if($this->isAjax())
        {
            $this->data->setData(
                ModelUsers::find()->toArray()
            );
        }

        $username = $this->column('username');
        $username->setLabel('Username');


        $email = $this->column('email');
        $email->setLabel('Email');

        $created = $this->column('created_at');
        $created->setLabel('Created_At');

        $avatar_id = $this->column('avatar_id');
        $avatar_id->setLabel('Avatar_Id');

        $this->add($username);
        $this->add($email);
        $this->add($created);
        $this->add($avatar_id);
        //$this->add($create_ip);


        $btn_add = $this->button('add');
        $btn_add
            ->setText('Add')
            ->type()->create()
            ->setEnabled(true);

        $btn_delete = $this->button('delete');
        $btn_delete
            ->setText('Delete')
            ->type()->remove()
            ->setEnabled(false);

        $btn_edit = $this->button('edit');
        $btn_edit
            ->setText('Edit')
            ->type()->edit()
            ->setEnabled(false);


        $this->add($btn_add);
        $this->add($btn_edit);
        $this->add($btn_delete);
    }

}