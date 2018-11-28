<?php
/**
 * Summary File DataTable
 *
 * Description File DataTable
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/16/2018
 * Time: 8:04 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;

use Lib\Contents\ContentBuilder;
use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class DataTable extends Component
{
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public parameters
	 */

    public $prefix;
    /** @var ContentBuilder $content */
    public $content;
    /** @var Data $data */
    public $data;
    /** @var Ajax $ajax */
    public $ajax;
    /** @var Responsive $response */
    public $response;
    /** @var Select $select */
    public $select;
    /** @var Columns $columns */
    public $columns;
    /** @var array $options */
    public $options = [
        'columns' => []
    ];

    /** @var DataTable $parent */
    private $parent;
    private $dom;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private parameters
	 */

    private $treeView = false;

    private $cssAfter   = [];
    private $cssBefore  = [];
    private $jsAfter   = [];
    private $jsBefore  = [];

    private $_title;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

    public function __construct()
    {
        $this->content  = ContentBuilder::instantiate();
        $this->ajax     = new Ajax($this);
        $this->data     = new Data($this);
        $this->response = new Responsive($this);
        $this->select   = new Select($this);
        $this->columns  = new Columns($this);
        $this->setDom('Blfrtip');
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    public function process()
    {
        $this->installBaseAssets();
        $this->runInitMethod();
        $this->addColumnTreeView();
        $this->data->process();
        $this->response->process();
        $this->select->process();
        $this->ajax->process();
        $this->eventSelectingIfHasParent();
//        $this->disableError();
        $this->assetsBeforeInitDataTable();

        $this->initDataTable();

    }

    public function disableError()
    {
        $this->content->assets->addJs( /** @lang JavaScript */
            "$.fn.dataTableExt.sErrMode = 'throw';"
        );
    }

    /**
     * @return DataTable|null
     */
    public function getParent()
    {
        if($this->parent)
            return $this->parent;
        return null;
    }

    /**
     * @param DataTable $parent
     */
    public function setParent( $parent )
    {
        $this->parent = $parent;
    }

    /**
     * @return bool
     */
    public function isTreeView()
    {
        return $this->treeView;
    }

    /**
     * @param bool $treeView
     */
    public function setTreeView( $treeView )
    {
        $this->treeView = $treeView;
    }

    public function column($name, $attributs = null)
    {
        return new Column($name, $attributs, $this);
    }

    public function button($name, $attributs = null)
    {
        return new Buttons($name, $attributs, $this);
    }

    public function add($obj)
    {
        if(is_object($obj))
            $obj->add();
    }

    /**
     * @return string
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param string $dom
     *
     * @see https://datatables.net/reference/option/dom
     */
    public function setDom( $dom = null )
    {
        if(!$dom)
            $dom = '';

        $this->options['dom'] = $dom;
        $this->dom = $dom;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle( $title )
    {
        $this->_title = $title;
    }

    public function addCss($css, $afterInit = true)
    {
        if($afterInit)
        {
            $this->cssAfter[] = $css;
        }
        else
        {
            $this->cssBefore[] = $css;
        }
    }

    public function addJs($js, $afterInit = true)
    {
        if($afterInit)
        {
            $this->jsAfter[$js] = $js;
        }
        else
        {
            $this->jsBefore[$js] = $js;
        }
    }

    public function isAjax()
    {
        if(
            $this->request->isAjax() &&
            $this->request->get('action_'.$this->prefix) !== null &&
            $this->security->checkHash(
                get_class($this).$this->prefix,
                $this->request->get('action_'.$this->prefix)
            )
        )
            return true;

        return false;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Protected methods
	 */

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

    private function runInitMethod()
    {
        if(method_exists($this, 'initialize'))
            $this->initialize();
    }

    private function installBaseAssets()
    {
        $this->content->assets->addCss(
            'assets/datatables.net-dt/css/jquery.dataTables.min.css'
        );

        $this->content->assets->addJs(
            'assets/jquery/dist/jquery.min.js'
        );
//        $this->content->assets->addJs(
//            'https://code.jquery.com/jquery-3.3.1.min.js'
//        );

        $this->content->assets->addJs(
            'assets/datatables.net/js/jquery.dataTables.min.js'
        );
    }

    private function prepareStrForJs()
    {
        $this->options['columns'] = $this->columns->getColumns();

        $str = json_encode($this->options);
        $str = str_replace('"||', '', $str);
        $str = str_replace('||"', '', $str);
        return $str;
    }

    private function addColumnTreeView()
    {
        if($this->isTreeView())
        {
            $parentField = $this->data->getParentField();
            $this->content->assets->addCss( /** @lang CSS */
                <<<TAG
td.details-control {
    background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAANbY1E9YMgAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAMDSURBVHjarFXdS5NRGH/eufyK2ZZWvqKiyZQQpQ9hNKVIHZLzpq7Ey8SbQhG66R+IPqCuCqKLrsK8kbCMhcOwNdimglZ24WSVHyxzVjqZQ9+P0/Mcz1upE7vwjB/nnOfjt3Oej/NKkHqYEGmIA4h0saahITYQiljr2x2lFHszIgthQeQgDgpSEGQJRByxikgiVARLdSoiy0QcRVR2dHRc8fv9nmg0OqvrukagNclIRzbCNjPFwbiATlWAcPT39z9VFGWD7TJIRzZkK3y2kEriSvmyLJ+LRCIfySmpJZk3Nsiuf+pmLaGLrDnYxLonO9mr7wMsoSY4MdmSD/oeExySJBJAsSoOBoN3HQ5H07KyDI+/PoI3S0M8OGTEpM1I0VR7uA6ull6D3PQ8CAQCHqfTeQPFMxRXI5O2rq6uhvb29k4NNOlO+DYMx4bRH386gv0DXYeZ5AxE1iJw4Ug9FBcWl8VisYnR0dFZSpJJEB5qbW29JEmS6d2SD3wxH2gaUmsqqLoG3roh8NYO8T1mB1TUjf0Yg7f4p+TT1tZ2WdzSbBBml5eXn6SAeqKvQVWRTFdBUdFZVf9kjuRch4QKknu+ebi8oqKCfLMpjmZRtOlWqzWXlFPxKXRQ8LISBFyBLaXgq/fz2ek9y+fPq1/4bLFYrEYDmLfXD8WMTrazsv4OVVN5qtaVjc0ywWsbOrPRTvF4/JfNZsuTM2SYW53nKT01cJrP4y3j3NjYi7xDQU4Bl6PvT9FFmkn05Vo4HJ4gpSvfxeO2GS+VJ8AYioghnZDWjXIjl09PT38gDjIxCFd6enr6sCz05sJmqLJWcSIOdDzRV8nBsy5kdosdWorcVEp6b2/vc9HfSppxh1AoFHe73faSopKyM3k1EF4J49XnttSizvgOqm3VcKvmJsjZMoyMjAxibz9Bjph4LFK33mJykT2YfMgaXrrY8Wd2Voo4/6Ke3Xt/n0UT0e2tl2+03n49Dlm7vTg7nq+FhYV5g4jWez1f//vAZgj9+l4PrLTfn4DfAgwAXP8AAdHdgRsAAAAASUVORK5CYII=') no-repeat center left;
    cursor: pointer;
    background-origin:content-box;
}
tr.details td.details-control {
    background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAANbY1E9YMgAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAALbSURBVHjarFVNTFNBEJ4tFVuw0gaj1Jhe5OdgJV5Iaw+CGAMKIdET4Sgh4SIHDcYLN07oiZOGqyFcjOECISEhwRpoGxLExAMVAi9NadIgWNLW8t7bdWa7L0Ap6oFtvsy+3Zlvd2ZnpnYoP2yICsQFRKWa0zARhwhdzXmpob3km6k1J8KFuIyoVqSgyLKIDOIAkUcYCFHuVkTmQFxF3BoYGHgWDodnk8mkxjk3CTSnNdojHaXrULanyOhW1xGB6enpD7quH4ozBu2RDukqmxOkTLlU5/V6721sbHwjI57Pi9z8vNgdHhY7PT0i1d0tdl+8FNmZGcGzWUlMumSDttcUB2PqAShWvuXl5bFAINDB9/chMzEBuYWF4rGMgsSACQECTRyhENQMDkJFbS0sLS3NhkKh16i1TXG1XtIzNDT0oL+//zmYJtt7Mwa5xc+Al0AmDlwKJKMfrunaNhibm+Bsa4MbPt/NdDq9GovFNHokmyKs6e3tfcIYs+XDYciGvwA3TQnT5EXJaW6qdQ65lRU8dBHIpq+v76ny0m4RVjU2Nt4h7w7m5qRhKY4OOALp0mhqaiLbKoqjXSVtpdvtrqXNfDwuldE3qMcblBs/WlulLGxtSelyudxWAZQmtkx90zTgb8M0DPlQTNeLaYJuH68UWU6ZTGbP4/FcqfB64XciIZ/2e/CuSixVCMeErAJvnfxG25+qikybqsvc+vr6qrx+e7uKkXEEQ8WNcxXPorx0v10SxuPxNeIgLovw1+Tk5EfKZ3dHBzj8/qIxt0gUkUWMh1TW14Pn8SNKIz41NfVJ1bd+IrGj0ejblpaWhwVNA210FA6iEfSPFV203EZnq5ubwTcyAs6GBohEInPBYPAVbmiKtHzpHabTIvnuvVjr6hIx/20R9fvF185OkRgfF4WdndLSq7NK77yag/OsjnOqfaVSqYRFRPN/tS/2nw32otov/KvBsvP+C/gjwAC23ACdhngbNwAAAABJRU5ErkJggg==') no-repeat center left;
    background-origin:content-box;
}
td.details-control.level-1 {
    padding-left:30px;
}
tr.details td.details-control.level-1 {
    padding-left:30px;
}
td.details-control.level-2 {
    padding-left:50px;
}
tr.details td.details-control.level-2 {
    padding-left:50px;
}
td.details-control.level-3 {
    padding-left:70px;
}
tr.details td.details-control.level-3 {
    padding-left:70px;
}
TAG
            );

            $this->content->assets->addJs(
            /** @lang JavaScript */
                <<<TAG
function compareObjectDesc(a, b) {
    if (a.id !== b.id) {
        return ((a.value < b.value) ? 1 : ((a.value > b.value) ? -1 : 0));
    } else if (typeof a.child === 'undefined' && typeof b.child === 'undefined') {
        return ((a.value < b.value) ? 1 : ((a.value > b.value) ? -1 : 0));
    } else if (typeof a.child !== 'undefined' && typeof b.child !== 'undefined') {
        return compareObjectDesc(a.child, b.child);
    } else {
        return typeof a.child !== 'undefined' ? 1 : -1;
    }
}

function compareObjectAsc(a, b) {
    if (a.id !== b.id) {
        return ((a.value < b.value) ? -1 : ((a.value > b.value) ? 1 : 0));
    } else if (typeof a.child === 'undefined' && typeof b.child === 'undefined') {
        return ((a.value < b.value) ? -1 : ((a.value > b.value) ? 1 : 0));
    } else if (typeof a.child !== 'undefined' && typeof b.child !== 'undefined') {
        return compareObjectAsc(a.child, b.child);
    } else {
        return typeof a.child !== 'undefined' ? 1 : -1;
    }
}

jQuery.fn.dataTableExt.oSort['custom-asc'] = function (a, b) {
    return compareObjectAsc(a, b);
};

jQuery.fn.dataTableExt.oSort['custom-desc'] = function (a, b) {
    return compareObjectDesc(a, b);
};

function buildOrderObject(dt, id, column) {
    var rowData = dt.row("#" + id).data();
    if (typeof rowData === 'undefined') {
        return {};
    } else {
        var object = buildOrderObject(dt, rowData[$parentField], column);
        var a = object;
        while (typeof a.child !== 'undefined') {
            a = a.child;
        }
        a.child = {};
        a.child.id = rowData['id'];
        a.child.value = rowData[column];
        return object;
    }
};
TAG

            );

            $this->columns->addFirstColumn([
                'class' => 'details-control',
                'data' => null,
                'orderable' => false,
                'defaultContent' => "",
                'width' => 50,
                'target' => 0,
                'createdCell' => "||".
                    "function (td, cellData, rowData, row, col) {".
                    "if (rowData._children === 0) { ".
                    "var space = '&nbsp;';".
                    "for(var i=0;i<rowData.level;i++){space = space+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'}".
                    "td.className = ''; $(td).append(space+'_'); ".
                    "}".
                    "if (rowData.level > 0) { ".
                    "td.className = td.className + ' level-' + rowData.level; ".
                    "}".
                    "}".
                    "||"
            ]);
        }
    }

    private function eventSelectingIfHasParent()
    {
        if($this->getParent())
        {
            $parent_table = $this->getParent()->prefix. '_table';
            $table = $this->prefix. '_table';
            $parentIndex = $this->data->getParentIndex();

            if($this->isTreeView())
                $levelParents = "$table.columns([$parentIndex]).search('^(0)$', true, false).draw();";

            $this->addJs( /** @lang JavaScript */
                "
$('#part_$this->prefix').hide();
$parent_table.on( 'select', function () {
    $table.ajax.reload();
    $('#part_$this->prefix').show();
    $levelParents
} );

$parent_table.on( 'deselect', function () {
    $table.ajax.reload();
    $('#part_$this->prefix').hide();
} );
"
);
        }
    }

    private function assetsBeforeInitDataTable()
    {
        foreach($this->cssBefore as $css)
        {
            $this->content->assets->addCss($css);
        }
        foreach($this->jsBefore as $js)
        {
            $this->content->assets->addJs($js);
        }
    }

    private function initDataTable()
    {
        $table = $this->prefix.'_table';

        $jsInitDt = "var $table = $('#$this->prefix').DataTable(".$this->prepareStrForJs().");";

        foreach($this->jsAfter as $js )
        {
            if (filter_var($js, FILTER_VALIDATE_URL) == true || file_exists($js)) {
                continue;
            }

            $jsInitDt .= $js;
        }

        // init dataTable
        $this->content->assets->addJs($jsInitDt);

        foreach($this->jsAfter as $js )
        {
            if(!file_exists($js))
            {
                continue;
            }
            $this->content->assets->addJs($js);
        }
    }
}