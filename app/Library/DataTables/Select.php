<?php
/**
 * Summary File Select
 *
 * Description File Select
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/18/2018
 * Time: 6:51 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Select extends Component
{
    private $select = true;

    public function toArray()
    {
        return [
            'style' => 'single'
        ];
    }
}