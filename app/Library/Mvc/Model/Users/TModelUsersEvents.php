<?php
/**
 * Summary File TModelUsersRelations
 *
 * Description File TModelUsersRelations
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/24/2018
 * Time: 6:10 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Users;



use Modules\Users\Session\Models\ModelUserIp;
use Phalcon\Http\Request;
use Phalcon\Mvc\Model\Transaction\Manager;

/**
 * @property Manager $transactions
 */
trait TModelUsersEvents
{
    public function beforeSave()
    {

    }

    public function beforeCreate()
    {
        $this->create_mode = true;
        $this->setCreatedAt(date('Y-m-d H:i:s'));

        $request = new Request();

        $ip = $request->getClientAddress();

        $this->setCreateIp($ip);

//      //  $ip = $this->getCreateIp();
//
//        $ipp = self:: findByCreateIp($ip);
//
//        $ippp = count($ipp);
//
//
//        $ip2 = new ModelUserIp();
//
//        $ip2->setCreateIp($ip);
//        $ip2->setCounter($ippp+1);
//
//
//        if($ip2->counter < 1)
//        {
//            $ip2->save();
//        }
//        elseif ($ip2->counter >= 1)
//        {
//             $ip2->update();
//          //  dump($ip2->getMessages());
//            //   dump($ip2->toArray());
//        }


    }

    public function beforeUpdate()
    {


    }



}