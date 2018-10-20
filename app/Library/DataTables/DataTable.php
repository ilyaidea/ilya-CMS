<?php
/**
 * Summary File DataTable
 *
 * Description File DataTable
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/16/2018
 * Time: 8:04 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;

use Lib\Mvc\Helper;
use Lib\Mvc\Helper\Content\ContentBuilder;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class DataTable extends Component
{
    protected $query;
    protected $action;
    private $ajax;
    private $columns;
    private $buttons;
    private $select;
    private $dom;
    private $event = [];

    public function __construct()
    {
        if($this->isAjax())
        {
            echo json_encode($this->query);
            die;
        }

        $this->helper->content()->setDtKey();

        $this->addCss( $this->url->getStaticBaseUri().'assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css' );
        $this->addJs( 'https://code.jquery.com/jquery-3.3.1.min.js' );
        $this->addJs( $this->url->getStaticBaseUri().'assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js' );

        $this->action = $this->security->hash( get_class( $this ) );

        $this->ajax = new Ajax();
        $this->columns = new Columns($this->query['data']);
        $this->buttons = new Buttons($this->helper->content()->getDtKey());
        $this->select = new Select();
        $this->dom = new Dom();
    }

    public function ajax()
    {
        return $this->ajax;
    }

    public function columns()
    {
        return $this->columns;
    }

    public function buttons()
    {
        return $this->buttons;
    }

    public function select()
    {
        return $this->select;
    }

    public function dom()
    {
        return $this->dom;
    }

    public function toArray()
    {
        $data = ( [
            'dom'    => $this->dom->toArray(),
            'ajax'    => $this->ajax->toArray( [ 'action' => $this->action ] ),
            'columns' => $this->columns->getColumns(),
            'titles'  => $this->columns->getTitles(),
        ] );

        if(!empty($this->buttons->toArray()))
        {
            $this->addCss(
                $this->url->getStaticBaseUri().
                'assets/DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css'
            );

            $this->addJs(
                $this->url->getStaticBaseUri().
                'assets/DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js'
            );

            $data['buttons'] = $this->buttons->toArray();
        }

        if(!empty($this->buttons->event()))
        {
            $data['event'] = array_merge($this->event, $this->buttons->event());
        }

        if(!empty($this->select->toArray()))
        {
            $this->addCss(
                $this->url->getStaticBaseUri().
                'assets/DataTables/Select-1.2.6/css/select.dataTables.min.css'
            );

            $this->addJs(
                $this->url->getStaticBaseUri().
                'assets/DataTables/Select-1.2.6/js/dataTables.select.min.js'
            );

            $data['select'] = $this->select->toArray();
        }



        return ($data);
    }

    public function addCss( $css )
    {
        ContentBuilder::getInstance()->getContent()->addCss( $css );
    }

    public function addJs( $js )
    {
        ContentBuilder::getInstance()->getContent()->addJs( $js );
    }

    protected function isAjax()
    {
        if($this->request->isAjax() && $this->security->checkHash(get_class($this), $this->request->getPost('action')))
        {
            return true;
        }
        return false;
    }

    public function setDtKey($dtKey)
    {
        $this->dtKey = $dtKey;
    }

}