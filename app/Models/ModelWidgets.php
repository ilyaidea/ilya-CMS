<?php
/**
 * Summary File Widgets
 *
 * Description File Widgets
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/21/2018
 * Time: 7:15 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Ilya\Models;


use Phalcon\Mvc\Model;

class ModelWidgets extends Model
{
    public $id;
    public $place;
    public $position;
    public $tags;
    public $namespace;

    public function initialize()
    {
        $this->setDbRef(true);
    }

    public function getSource()
    {
        return 'ilya_widgets';
    }
}