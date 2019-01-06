<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 12/31/2018
 * Time: 01:12 PM
 */

namespace Modules\Users\Session\Models\UserIp;


use Lib\Mvc\Model;

class ModelUserIp extends Model
{
    use TraitModelUserIpProperties;

    public function getSource ()
    {
        return 'ilya_users_ip';
    }

}