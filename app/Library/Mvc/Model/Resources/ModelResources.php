<?php
/**
 * Summary File ModelResources
 *
 * Description File ModelResources
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 1/13/2019
 * Time: 9:54 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2019, ILYA-IDEA Company
 */

namespace Lib\Mvc\Model\Resources;


use Lib\Mvc\Model;

class ModelResources extends Model
{
    use TModelResourcesProperties;
    use TModelResourcesRelations;

    public function init()
    {
        $this->setSource('ilya_resources');
        $this->setDbRef(true);
    }
}