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

    public function __construct(DataTable $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

    public function process()
    {
//        $this->parentTarget = array_search($this->parentField, $this->getDataKeys());
        if($this->dataTable->isCustom())
        {
            for ($i = 0; $i < count($this->dataKeys); $i++)
            {
                array_push(
                    $this->dataTable->options['columns'],
                    [
                        'title' => $this->dataKeys[$i],
                        'target' => $i+1,
                        'data' => $this->dataKeys[$i]
                    ]
                );
            }
        }

        // search key index parent id
        if($this->dataTable->isTreeView())
        {
            $i = 0;
            foreach($this->dataTable->options['columns'] as $column)
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

        if(!$this->dataTable->ajax->isAjax() && isset($this->dataTable->options['ajax']))
        {
            unset($this->dataTable->options['ajax']);
            $this->dataTable->options['data'] = '||data_'. $this->dataTable->prefix.'||';

            $dataVar = 'data_'. $this->dataTable->prefix;
            $dataEncode = json_encode($this->getData());

            $this->dataTable->content->assets->addJs( /** @lang JavaScript */
                "var $dataVar = $dataEncode;"
            );
        }

        if(
            $this->request->isAjax() &&
            $this->request->get('action_'.$this->dataTable->prefix) !== null &&
            $this->security->checkHash(
                get_class($this->dataTable).$this->dataTable->prefix,
                $this->request->get('action_'.$this->dataTable->prefix)
            )
        )
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
    public function getParentIndex(): int
    {
        return $this->parentIndex;
    }

    /**
     * @return array
     */
    public function getDataKeys(): array
    {
        return $this->dataKeys;
    }

    /**
     * @return string
     */
    public function getParentField(): string
    {
        return $this->parentField;
    }

    /**
     * @param string $parentField
     */
    public function setParentField( string $parentField ): void
    {
        $this->parentField = $parentField;
    }





    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

    private function dataProcess(array $data)
    {
        foreach($data as $dt)
        {
            if($this->dataKeys == [])
            {
                $this->dataKeys = array_keys($dt);
                if (($key = array_search('children', $this->dataKeys)) !== false) {
                    unset($this->dataKeys[$key]);
                }
            }
            break;
        }

        if(!$this->dataTable->isTreeView())
            return $data;

        return $this->tree($data);
    }

    public function jsForTreeView()
    {
        $parentIndex = $this->getParentIndex();
        $prefix = $this->dataTable->prefix;
        $jsInitDt = /** @lang JavaScript */
            "
$('#$prefix').on('init.dt', function () {
        $prefix.columns([$parentIndex]).search('^(0)$', true, false).draw();
    });
    var displayed = new Set([]);
    $('#$prefix tbody').on('click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = $prefix.row(tr);
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
        $prefix.columns([$parentIndex]).search(regex, true, false).draw();
    });
    
    		$('#".$prefix."_filter input[type=\'search\']').on('keyup', function () {
        		var value = $(this).val();
            
        		if (value === '') {
        		    $prefix.columns([$parentIndex]).search('^(0)$', true, false).draw();
                }
        		else {
                    $prefix.columns([$parentIndex]).search('^([0-9]*)$', true, false).draw();
        		}
        		
            $prefix.search(value).draw();
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