<?php
/**
 * Summary File Languages
 *
 * Description File Languages
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/16/2018
 * Time: 8:20 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\System\Native\DataTables;

use Lib\DataTables\DataTable;
use Lib\Mvc\Helper\CmsCache;
use Modules\System\Native\Models\Language;
use Modules\System\Native\Models\Translate;

class TranslatesDataTable extends DataTable
{
    public function __construct()
    {
        $this->query['data'] = Translate::find([
            'columns' => 'id,phrase,translation',
            'conditions' => 'language = :lang:',
            'bind' => [
                'lang' => $this->helper->locale()->getLanguage()
            ]
        ])->toArray();

//        dump($this->query);
        parent::__construct();

        $this->columns()
            ->setData('phrase')
            ->setTitle($this->helper->t('phrase'));
        $this->columns()
            ->setData('translation')
            ->setTitle('Translation');

        $this->buttons()->add(
            $this->helper->t('add')
        );
        $this->buttons()->edit('Edit');
        $this->buttons()->delete('Delete');

//        $langs['data'] = ModelLanguage::find()->toArray();
//
//        echo "<pre>";
//        die(print_r($langs));
    }
}