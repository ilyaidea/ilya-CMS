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
    private $ajaxUrl;
    private $dataSrc = 'data';
    private $data = [];
    private $type = 'post';

    public function __construct()
    {
        $this->ajaxUrl = rtrim($this->url->getBaseUri(), '/'). $this->router->getRewriteUri();
    }

    public function toArray($data = [])
    {
        $result = [
            'url' => $this->ajaxUrl,
            'dataSrc' => $this->dataSrc,
            'type' => $this->type,
        ];

        if(!empty($data))
        {
            foreach($data as $key => $val)
            {
                $result['data'][$key] = $val;
            }
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->ajaxUrl;
    }

    /**
     * @param mixed $url
     */
    public function setUrl( $url )
    {
        $this->ajaxUrl = $url;
    }

    /**
     * @return string
     */
    public function getDataSrc()
    {
        return $this->dataSrc;
    }

    /**
     * @param string $dataSrc
     */
    public function setDataSrc( $dataSrc )
    {
        $this->dataSrc = $dataSrc;
    }




}