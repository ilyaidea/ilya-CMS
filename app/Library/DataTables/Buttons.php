<?php
/**
 * Summary File Buttons
 *
 * Description File Buttons
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 5:35 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class Buttons extends Component
{
    private $buttons = [];
    private $event = [];
    private $key = 0;
    protected $dtKey;

    public function __construct($dtKey)
    {
        $this->dtKey = $dtKey;
    }

    public function toArray()
    {
        return $this->buttons;
    }

    public function event()
    {
        return $this->event;
    }

    public function add($title)
    {
        $url = $this->url->get([
            'for' => 'default__'. $this->helper->locale()->getLanguage(),
            'module' => $this->config->module->name,
            'controller' => $this->dispatcher->getControllerName(),
            'action' => 'add'
        ]);

        $this->buttons[$this->key]['text'] = $title;
        $this->buttons[$this->key]['action'] = "function (e, dt, node, config){".
            "window.location.href = '".$url."';".
            "return false;".
            " }";

        $this->key++;
    }

    public function edit( $title )
    {
        $url = $this->url->get([
            'for' => 'default__'. $this->helper->locale()->getLanguage(),
            'module' => $this->config->module->name,
            'controller' => $this->dispatcher->getControllerName(),
            'action' => 'edit'
        ]);

        $this->buttons[$this->key]['text'] = $title;
        $this->buttons[$this->key]['action'] = "function (e, dt, node, config){".
            "var id = dt.row( { selected: true } ).data().id;".
            "window.location.href = '".$url."/'+id;".
            "return false;".
            " },";
        $this->buttons[$this->key]['enabled'] = false;

        $this->event[] = ".on( 'select deselect', function () {
            var selectedRows = ".$this->dtKey.".rows( { selected: true } ).count();
     
            ".$this->dtKey.".button( ".$this->key." ).enable( selectedRows === 1 );
        } );";

        $this->key++;
    }

    public function delete( $title )
    {
        $url = $this->url->get([
            'for' => 'default__'. $this->helper->locale()->getLanguage(),
            'module' => $this->config->module->name,
            'controller' => $this->dispatcher->getControllerName(),
            'action' => 'delete'
        ]);

        $this->buttons[$this->key]['text'] = $title;
        $this->buttons[$this->key]['action'] = "function (e, dt, node, config){".
            "var id = dt.row( { selected: true } ).data().id;".
            "window.location.href = '".$url."/'+id;".
            "return false;".
            " },";
        $this->buttons[$this->key]['enabled'] = false;

        $this->event[] = ".on( 'select deselect', function () {
            var selectedRows = ".$this->dtKey.".rows( { selected: true } ).count();
     
            ".$this->dtKey.".button( ".$this->key." ).enable( selectedRows >= 1 );
        } );";

        $this->key++;

    }
}