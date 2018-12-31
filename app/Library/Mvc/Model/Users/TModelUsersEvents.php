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

      //  $this->setCreateIp($ip);

      // $ip = $this->getCreateIp();

        $ipp = self::findByCreateIp($ip);

        if(count($ipp)>3)
        {
            dump('stop!!!');
            return;
        }
        else
        $this->setCreateIp($ip);

    }

    public function afterCreate()
    {
    }

    public function a()
    {
        $ip = $this->getCreateIp();

        $ipp = self::findByCreateIp($ip);

        if(count($ipp)>3)
        {
            dump('stop!!!');
            return;
        }
    }

}