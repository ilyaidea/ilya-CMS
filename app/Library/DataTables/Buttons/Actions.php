<?php
/**
 * Summary File Actions
 *
 * Description File Actions
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/25/2018
 * Time: 2:53 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables\Buttons;


use Lib\DataTables\Buttons;
use Lib\DataTables\DataTable;

class Actions
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;
    /** @var Buttons $_btn */
    protected $_btn;

    protected $options = [];
    public $storage = [];

    public function __construct($btn, $dt)
    {
        $this->_dataTable = $dt;
        $this->_btn = $btn;
    }

    public function add()
    {
        if(!empty($this->storage))
        {
            $action = "||function(e,dt,node,config){";

            foreach($this->storage as $value)
            {
                // remove new line from string
                $action .= trim(preg_replace('/\s+/', ' ', $value));;
            }

            $action .= "}||";

            $this->_btn->options['action'] = $action;
        }
    }

    /**
     * Set redirect to Url until clicked by user
     *
     * @param string $url
     * @return Buttons
     */
    public function setUrl($url)
    {
        $this->options['url'] = $url;
        $this->storage[] = "window.location.href = '$url';";

        return $this->_btn;
    }

    public function getUrl()
    {
        if(isset($this->options['url']))
            return $this->options['url'];
        return null;
    }
}