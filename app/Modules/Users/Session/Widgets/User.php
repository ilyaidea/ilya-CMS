<?php
/**
 * Created by PhpStorm.
 * User: Torab
 * Date: 01/08/2019
 * Time: 08:34 AM
 */
/*
	Widget Name: User
	Widget URI:
	Widget Description: User description
	Widget Version: 1.0
	Widget Date: 2018-03-27
	Widget Author: Atieh Torab
	Widget Author URI: https://www.ilyaidea.ir/
	Widget License: GPLv2
	Widget Minimum IlyaIdea Version: 1.0
	Widget Update Check URI:
*/
namespace Modules\Users\Session\Widgets;


use Lib\Authenticates\Auth;
use Lib\Widget\WidgetAbstract;

/**
 * Class User
 * @package Modules\Users\Session\Widgets
 *  @property Auth $auth
 */
class User extends WidgetAbstract
{
    public function initialize($params = null)
    {
       // dump($this->router->getRewriteUri());

        return [
            'name' => 'user'
        ];
    }
}