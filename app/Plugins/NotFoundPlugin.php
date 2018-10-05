<?php
/**
 * Summary File NotFoundPlugin
 *
 * Description File NotFoundPlugin
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 9/26/2018
 * Time: 6:44 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Plugins;


use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class NotFoundPlugin
{
    public function beforeException(Event $event, Dispatcher $dispatcher, \Exception $exception)
    {
        $dispatcher->forward(
            [
                'module' => 'session',
                'controller' => 'index',
                'action' => 'error'
            ]
        );

        return false;
    }
}