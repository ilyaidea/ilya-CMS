<?php
/**
 * Summary File ModelLanguage
 *
 * Description File ModelLanguage
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/11/2018
 * Time: 6:08 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Native\Models\Language;

use Lib\Mvc\Helper\CmsCache;
use Lib\Mvc\Model;
use Modules\System\Native\Models\ModelTranslate;
use Phalcon\Di;
use Phalcon\Mvc\Model\Query\Builder;

class ModelLanguage extends Model
{
    use TraitPropertiesLanguage;
    use TraitValidationLanguage;
    use TraitEventsLanguage;
    use TraitRelationsLanguage;

    public function init()
    {
        $this->setSource('ilya_language');
    }



}