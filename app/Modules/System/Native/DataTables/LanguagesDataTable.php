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
use Modules\System\Native\Models\Language;

class LanguagesDataTable extends DataTable
{
    public function __construct()
    {
        $this->query['data'] = Language::findAllForDataTable();

//        dump($this->query);
        parent::__construct();

        $this->columns()
            ->setData('title')
            ->setTitle('Title');
        $this->columns()
            ->setData('iso')
            ->setTitle('Iso');
        $this->columns()
            ->setData('position')
            ->setTitle('Position');
        $this->columns()
            ->setData('is_primary')
            ->setTitle('Is Primary');
        $this->columns()
            ->setData('direction')
            ->setTitle('Direction');

        $this->buttons()->add(
            $this->helper->t('add')
        );
        $this->buttons()->edit('Edit');
        $this->buttons()->delete('Delete');
    }
}