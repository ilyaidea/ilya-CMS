<?php
/**
 * Summary File Pages
 *
 * Description File Pages
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/27/2018
 * Time: 8:34 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\PageManager\Models\Pages;

use Lib\Events\IModelEvents;
use Lib\Mvc\Model;
use Phalcon\Di;

class ModelPages extends Model implements IModelEvents
{
    use TraitPropertiesPagesModel;
    use TraitValidationsPagesModel;
    use TraitEventsPagesModel;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('ilya_pages');
    }

    public static function findAllParentsByLang($lang = null)
    {
        if(!$lang)
        {
            return [];
        }

        $findAllParentsByLang = self::find([
            'conditions' => 'language = :lang:',
            'bind' => [
                'lang' => $lang
            ]
        ])->toArray();

        return array_column($findAllParentsByLang, 'id');
    }

}