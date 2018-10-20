<?php
/**
 * Summary File Columns
 *
 * Description File Columns
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 11:59 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Columns extends Component
{
    private $columns = [];
    private $titles = [];
    private $state;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param \stdClass $columns
     */
    public function setData( $data )
    {
        $this->columns[$data]['data'] = $data;
        $this->titles[$data] = $data;
        $this->state = $data;

        foreach($this->data as $value)
        {
            if(isset($value[$data]['display']) && isset($value[$data]['value']))
            {
                $this->columns[$data]['render']['_'] = 'display';
                $this->columns[$data]['render']['sort'] = 'value';
            }
            break;
        }

        return $this;
    }

    public function setTitle( $title )
    {
        if($this->state)
        {
            $this->titles[$this->state] = $title;
            return $this;
        }
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return array_values($this->columns);
    }

    /**
     * @return array
     */
    public function getTitles()
    {
        return array_values($this->titles);
    }
}