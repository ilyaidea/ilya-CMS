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


use Lib\DataTables\Buttons\Actions;
use Lib\DataTables\Buttons\Types;
use Phalcon\Mvc\User\Component;

class Buttons extends Component
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;
    /** @var Types $_type */
    protected $_type;

    /** @var Actions $_actions */
    protected $_actions;

    protected $_attributes = [];

    public $options = [];

    public function __construct($name, $attributes = null, $dataTable)
    {
        $this->options['name'] = $name;
        $this->_dataTable      = $dataTable;
        $this->_type           = new Types($this, $dataTable);
        $this->_actions        = new Actions($this, $dataTable);
    }

    public function add()
    {
        if(!empty($this->_dataTable->columns->getColumns()))
        {
            $this->_dataTable->content->assets->addCss(
                'assets/datatables.net-buttons-dt/css/buttons.dataTables.min.css'
            );
            $this->_dataTable->addJs(
                'assets/datatables.net-buttons/js/dataTables.buttons.min.js'
            );

            $this->action()->add();

            $this->_dataTable->options['buttons'][] = $this->options;
        }
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return Buttons
     */
    public function setName($name = '')
    {
        $this->options['name'] = $name;

        return $this;
    }

    public function getName()
    {
        if(isset($this->options['name']) && is_string($this->options['name']))
            return $this->options['name'];
        return null;
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return Buttons
     */
    public function setText($title = '')
    {
        $this->options['text'] = $title;

        return $this;
    }

    /**
     * Get Title
     *
     * @return mixed|null
     */
    public function getText()
    {
        if(isset($this->options['text']) && is_string($this->options['text']))
            return $this->options['text'];
        return null;
    }

    /**
     * Set Enabled
     *
     * @param bool $enabled
     * @return Buttons
     */
    public function setEnabled($enabled)
    {
        $this->options['enabled'] = $enabled;

        return $this;
    }

    /**
     * Get Enabled
     *
     * @return mixed|null
     */
    public function getEnabled()
    {
        if(isset($this->options['enabled']) && is_bool($this->options['enabled']))
            return $this->options['enabled'];
        return null;
    }

    /**
     * Built-in Buttons list
     *
     * @return Types
     * @see https://datatables.net/reference/button/
     */
    public function type()
    {
        return $this->_type;
    }

    /**
     * Action to take when the button is activated
     *
     * This function defined the action that the button will take when activated by the end user. This will normally be to perform some operation on the DataTable, but can be absolutely anything since the function can be defined by yourself.
     *
     * @see https://datatables.net/reference/option/buttons.buttons.action
     * @return Actions
     */
    public function action()
    {
        return $this->_actions;
    }
}