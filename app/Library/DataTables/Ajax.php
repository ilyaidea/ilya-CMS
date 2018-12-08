<?php
/**
 * Summary File Ajax
 *
 * Description File Ajax
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 10:43 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Ajax extends Component
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private parameters
	 */

    /** @var DataTable $dataTable */
    private $dataTable;

    private $currentUrl;

    private $isAjax = true;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Const
	 */

    const POST_DATA = 'POST';
    const GET_DATA = 'GET';

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

    public function __construct($dataTable)
    {
        $this->dataTable = $dataTable;
        $this->setUrl();
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    public function process()
    {
        $this->dataTable->options['ajax']['dataSrc'] = 'data_'.$this->dataTable->prefix;

        if($this->dataTable->getParent())
        {
            $dt_parent = $this->dataTable->getParent()->prefix.'_table';
            $dt = $this->dataTable->prefix;
            $action = $this->security->hash(
                get_class($this->dataTable). $this->dataTable->prefix
            );
            $this->dataTable->options['ajax']['data'] = "||function(d){";

            $str = "";
            $str .= "var selected = $dt_parent.row({selected:true});";
            $str .= "d.action_$dt = '$action';";
            $str .= "if(selected.any()){d._id = selected.data().id;}";
            $this->dataTable->options['ajax']['data'] .= $str;
            $this->dataTable->options['ajax']['data'] .= "}||";
        }
        else
        {
            $this->dataTable->options['ajax']['data']['action_'.$this->dataTable->prefix] =
                $this->security->hash(
                    get_class($this->dataTable). $this->dataTable->prefix
                );
        }
    }

    public function setType($type = self::GET_DATA)
    {
        if(!$this->isAjax)
            return null;

        $this->dataTable->options['ajax']['type'] = $type;
    }

    public function getType()
    {
        if(!$this->isAjax)
            return null;

        if(isset($this->dataTable->options['ajax']['type']))
        {
            return $this->dataTable->options['ajax']['type'];
        }

        return 'GET';
    }

    public function setUrl($url = null)
    {
        if(!$this->isAjax)
            return null;

        if($url === null)
        {
            $this->currentUrl = $this->url->get([
                'for' => 'default__'. $this->helper->locale()->getLanguage(),
                'module' => $this->config->module->name,
                'controller' => $this->dispatcher->getControllerName(),
                'action' => $this->dispatcher->getActionName()
            ]);
            $url = $this->currentUrl;
        }
        return $this->dataTable->options['ajax']['url'] = $url;
    }

    public function getUrl()
    {
        if(!$this->isAjax)
            return null;

        if(isset($this->dataTable->options['ajax']['url']))
        {
            return $this->dataTable->options['ajax']['url'];
        }

        return $this->currentUrl;
    }

    /**
     * Get / Set isAjax
     */
    public function isAjax( $isAjax = null )
    {
        if($isAjax === null)
            return $this->isAjax;

        if($isAjax === true)
            $this->isAjax = true;
        elseif($isAjax === false)
            $this->isAjax = false;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Protected methods
	 */

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

}