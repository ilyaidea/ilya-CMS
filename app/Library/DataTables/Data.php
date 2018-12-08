<?php
/**
 * Summary File Data
 *
 * Description File Data
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/19/2018
 * Time: 10:41 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\DataTables;


use Phalcon\Mvc\User\Component;

class Data extends Component
{
    private $dataTable;
    private $data;
    private $dataKeys = [];
    private $parentField = 'parent_id';
    private $parentIndex = 0;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

    public function __construct($dataTable)
    {
        $this->dataTable = $dataTable;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    public function process()
    {
        // search key index parent id
        if($this->dataTable->isTreeView())
        {
            $i = 0;
            foreach($this->dataTable->columns->getColumns() as $column)
            {
                if(isset($column['data']) && $column['data'] == $this->parentField)
                {
                    $this->parentIndex = $i;
                    break;
                }
                $i++;
            }

            $this->dataTable->addJs($this->jsForTreeView());
        }

        if($this->dataTable->isAjax())
        {
            dump(json_encode(
                [
                    'data_'.$this->dataTable->prefix => $this->data
                ]
            ));
        }
//        $this->data = json_decode(json_encode($this->data), false);
    }

    /**
     * Summary Function setData
     *
     * Description Function setData
     *
     * @author Ali Mansoori
     * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
     * @param array $data
     * @version 1.0.0
     * @example Desc <code></code>
     */
    public function setData( array $data = [])
    {
        // process data
        if(!empty($data) && is_array($data))
        {
            $data = $this->dataProcess($data);
        }

        if($this->dataTable->isTreeView())
        {
            $this->data = $this->flatArray($data);
        }
        else
        {
            $this->data = $data;
        }

    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getParentIndex()
    {
        return $this->parentIndex;
    }

    /**
     * @return array
     */
    public function getDataKeys()
    {
        return $this->dataKeys;
    }

    /**
     * @return string
     */
    public function getParentField()
    {
        return $this->parentField;
    }

    /**
     * @param string $parentField
     */
    public function setParentField( string $parentField )
    {
        $this->parentField = $parentField;
    }





    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

    private function dataProcess(array $data)
    {
        if(!$this->dataTable->isTreeView())
            return $data;

        return $this->tree($data);
    }

    public function jsForTreeView()
    {
        $parentIndex = $this->getParentIndex();
        $table = $this->dataTable->prefix.'_table';
        $prefix = $this->dataTable->prefix;
        $jsInitDt = /** @lang JavaScript */
            "
$('#$prefix').on('init.dt', function () {
        $table.columns([$parentIndex]).search('^(0)$', true, false).draw();
    });
    var displayed = new Set([]);
    $('#$prefix tbody').on('click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = $table.row(tr);
        var id = row.data().id;
        if (displayed.has(id)) {
            displayed.delete(id);
            tr.removeClass('details');
        } else {
            displayed.add(id);
            tr.addClass('details');
        }
        var regex = \"^(0\";
        displayed.forEach(function (value) {
            regex = regex + \"|\" + value;
        });
        regex = regex + \")$\";
        $table.columns([$parentIndex]).search(regex, true, false).draw();
    });
    
    		$('#".$prefix."_filter input[type=\'search\']').on('keyup', function () {
        		var value = $(this).val();
            
        		if (value === '') {
        		    $table.columns([$parentIndex]).search('^(0)$', true, false).draw();
                }
        		else {
                    $table.columns([$parentIndex]).search('^([0-9]*)$', true, false).draw();
        		}
        		
            $table.search(value).draw();
        });
";
        return $jsInitDt;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Protected methods
	 */

    protected function tree($arrays, $parent = null, $level = 0)
    {
        $result = [];
        foreach($arrays as $array)
        {
            if(!isset($array[$this->parentField]))
            {
                $array[$this->parentField] = null;
                $this->dataKeys[7] = $this->parentField;
            }

            if($array[$this->parentField] == $parent)
            {
                $array['level'] = $level;
                $newLevel = $level+1;
                $children = $this->tree($arrays, $array['id'], $newLevel);
                if(!empty($children))
                    $array['children'] = $children;
//                unset($array[$this->parentField]);
                $result[] = $array;
            }
        }

        return $result;
    }

    protected function flatArray($arrays)
    {
        $result = [];
        foreach($arrays as $array)
        {
            if($array[$this->parentField] == null)
            {
                $array[$this->parentField] = 0;
            }
            $new_arr = $array;
            $array['_children'] = 0;
            if(isset($array['children']) && count($array['children']) > 0)
            {
                $array['_children'] = count($array['children']);
            }
            unset($array['children']);
            $result[] = $array;
            if(isset($new_arr['children']) && count($new_arr['children']) > 0)
            {
                $result = array_merge($result, $this->flatArray($new_arr['children']));
            }
        }

        return $result;
    }


}