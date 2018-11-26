<?php
/**
 * Summary File Types
 *
 * Description File Types
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/25/2018
 * Time: 1:53 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\DataTables\Buttons;

use http\Url;
use Lib\DataTables\Buttons;
use Lib\DataTables\DataTable;

class Types
{
    /** @var DataTable $_dataTable */
    protected $_dataTable;
    /** @var Buttons $_btn */
    protected $_btn;

    public function __construct(Buttons $btn, DataTable $dt)
    {
        $this->_dataTable = $dt;
        $this->_btn = $btn;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  * * *
    /* Buttons
     */

    public function collection()
    {

    }

    public function columnsToggle()
    {

    }

    public function columnsVisibility()
    {

    }

    public function colvis()
    {

    }

    public function colvisGroup()
    {

    }

    public function colvisRestore()
    {

    }

    /**
     * Copy table data to clipboard button
     *
     * This is provided as there is no API in HTML5 that allows a copy to clipboard action when clicking a button. Flash however does provide that option, giving a potentially more desirable interface to the end user.
     *
     * @return Buttons
     */
    public function copy()
    {
        $this->_dataTable->addJs(
            'assets/datatables.net-buttons/js/buttons.flash.min.js',
            false
        );

        $this->_dataTable->addJs(
            'assets/datatables.net-buttons/js/buttons.html5.min.js',
            false
        );

        $this->_btn->options['extend'] = 'copy';

        return $this->_btn;
    }

    public function copyFlash()
    {

    }

    public function copyHtml5()
    {

    }

    public function csv()
    {

    }

    public function csvFlash()
    {

    }

    public function csvHtml5()
    {

    }

    public function excel()
    {

    }

    public function excelFlash()
    {

    }

    public function excelHtml5()
    {

    }

    public function pageLength()
    {

    }

    public function pdf()
    {

    }

    public function pdfFlash()
    {

    }

    public function pdfHtml5()
    {

    }

    public function print()
    {

    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  * * *
    /* Editor
     */

    public function create($url=null)
    {
        if(!$url)
        {
            $url = $this->_dataTable->content->url->get([
                'for' => 'default__'. $this->_dataTable->content->helper->locale()->getLanguage(),
                'module' => $this->_dataTable->content->config->module->name,
                'controller' => $this->_dataTable->content->dispatcher->getControllerName(),
                'action' => 'add'
            ]);
        }
        $this->_btn->action()->storage[] = /** @lang JavaScript */
            <<<TAG
window.location.href = '$url';return false;
TAG;
        return $this->_btn;
    }

    public function edit($url=null)
    {
        if(!$url)
        {
            $url = $this->_dataTable->content->url->get([
                'for' => 'default__'. $this->_dataTable->content->helper->locale()->getLanguage(),
                'module' => $this->_dataTable->content->config->module->name,
                'controller' => $this->_dataTable->content->dispatcher->getControllerName(),
                'action' => 'edit'
            ]);
        }
        $this->_btn->action()->storage[] = /** @lang JavaScript */
            <<<TAG
var id = dt.row({selected:true}).data().id;window.location.href = '$url'+id;return false;
TAG;
        $dt = $this->_dataTable->prefix;
        $btn_name = $this->_btn->getName();
        $this->_dataTable->addJs( /** @lang JavaScript */
            <<<TAG
$dt.on('select deselect', function(e, dt, type, indexes) {
    var count = dt.rows({selected:true}).count();
    if (count > 1 || count == 0){
        dt.button('$btn_name:name').disable();
    }else {
        dt.button('$btn_name:name').enable();
    }
});

TAG
);
        return $this->_btn;

    }

    public function editSingle()
    {

    }

    public function remove($url=null)
    {
        if(!$url)
        {
            $url = $this->_dataTable->content->url->get([
                'for' => 'default__'. $this->_dataTable->content->helper->locale()->getLanguage(),
                'module' => $this->_dataTable->content->config->module->name,
                'controller' => $this->_dataTable->content->dispatcher->getControllerName(),
                'action' => 'delete'
            ]);
        }
        $this->_btn->action()->storage[] = /** @lang JavaScript */
            <<<TAG
var id = dt.row({selected:true}).data().id;window.location.href = '$url'+id;return false;
TAG;
        $dt = $this->_dataTable->prefix;
        $btn_name = $this->_btn->getName();
        $this->_dataTable->addJs( /** @lang JavaScript */
            <<<TAG
$dt.on('select deselect', function(e, dt, type, indexes) {
    var count = dt.rows({selected:true}).count();
    if (count > 1 || count == 0){
        dt.button('$btn_name:name').disable();
    }else {
        dt.button('$btn_name:name').enable();
    }
});

TAG
        );
        return $this->_btn;


    }

    public function removeSingle()
    {

    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  * * *
    /* Select
     */

    public function selectAll()
    {

    }

    public function selectCells()
    {

    }

    public function selectColumns()
    {

    }

    public function selected()
    {

    }

    public function selectedSingle()
    {

    }

    public function selectNone()
    {

    }

    public function selectRows()
    {

    }
}