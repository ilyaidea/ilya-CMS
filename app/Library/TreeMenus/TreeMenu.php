<?php
/**
 * Summary File TreeMenu
 *
 * Description File TreeMenu
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/24/2018
 * Time: 11:40 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\TreeMenus;

use Lib\Forms\Form;
use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class TreeMenu extends Component implements ITreeMenu
{
    private $storage = [];
    protected $content;
    private $ajaxUrl;

    private $extra = [];
    private $buttons;

    // Maps
    private $textMap;
    private $iconMap;
    private $idMap;
    private $parentMap;

    public function __construct()
    {
        $this->content = $this->helper->content();
        $this->neccessaryFiles();
        $this->setAjaxUrl();
    }

    protected function neccessaryFiles()
    {
        $this->content->addCss('ilya-theme/base/assets/jstree/dist/themes/default/style.css');
        $this->content->addJs('ilya-theme/base/assets/jstree/dist/jstree.min.js');
    }

    public function setAjaxUrl($url = null)
    {
        if(!$url)
        {
            $this->ajaxUrl = $this->url->get([
                'for' => 'default__'. $this->helper->locale()->getLanguage(),
                'module' => $this->config->module->name,
                'controller' => $this->dispatcher->getControllerName(),
                'action' => $this->dispatcher->getActionName(),
            ]);
        }
    }

    public function initialize()
    {
        // TODO: Implement initialize() method.
    }

    public function create()
    {
        $key = $this->storage['key'];
        if( isset( $key ) )
        {
            $js = '$(function () {
                        $("#ilya_body_'.$key.'").jstree({';

            $js .= '
                "core" : {
                    "data" : {
                        "url" : "'.$this->ajaxUrl.'",
                        "dataType" : "json" ,
                        "type" : "post" ,
                        "data": {action: "'.$key.'"}
                    }
		        }            
            ';

            $js .= '});});';
        }
        $this->helper->content()->getContent()->addJs($js);
    }

    public function setKey($key)
    {
        $this->storage['key'] = $key;
    }

    public function getKey()
    {
        return $this->storage['key'];
    }

    public function toArray()
    {
        $this->isAjax();
        $this->initialize();
        $this->create();


        if($this->buttons)
        {
            $this->extra['buttons'] = $this->buttons->getStorage();
        }

        $extra = [];
        foreach($this->extra as $key => $value)
        {
            if(is_object($value))
            {
                $extra[$key] = $value->toArray();
            }
            else
            {
                $extra[$key] = $value;
            }
        }

        return array_merge($this->storage, $extra);
    }

    public function data()
    {
        return [];
    }

    protected function prepareDataForJsTree($data, $textMap = null, $iconMap = null, $idMap = null, $parentMap = 'parent_id')
    {
        $this->textMap = $textMap;
        $this->idMap = $idMap;
        $this->iconMap = $iconMap;
        $this->parentMap = $parentMap;

        $data = array_map(
            function($tag) {
                $row['id'] = ($this->idMap) ? $tag[$this->idMap] : ((isset($tag['id'])) ? $tag['id'] : null);
                $row['text'] = ($this->textMap) ? $tag[$this->textMap] : ((isset($tag['text'])) ? $tag['text'] : null);
                $row['icon'] = ($this->iconMap) ? $tag[$this->textMap] : ((isset($tag['icon'])) ? $tag['icon'] : null);
                unset($tag[$this->textMap]);
                unset($tag[$this->iconMap]);
                unset($tag[$this->idMap]);
                return array_merge($tag, $row);
            },
            $data
        );

        return $data;
    }

    protected function tree($arrays, $parent = null, $parentLabel = 'parent_id')
    {
        $result = [];
        foreach($arrays as $array)
        {
            if($array[$this->parentMap] == $parent)
            {
                $children = $this->tree($arrays, $array['id'], $this->parentMap);
                $array['children'] = $children;
                unset($array[$this->parentMap]);
                $result[] = $array;
            }
        }

        return $result;
    }

    protected function isAjax()
    {
        if($this->request->isAjax() && ($this->request->getPost('action') == $this->storage['key']))
        {
            dump(json_encode(
                    $this->tree(
                        $this->prepareDataForJsTree(
                            $this->data()
                        )
                    )
                )
            );
        }
    }

    //

    public function addForm($form, $internal = false)
    {
        if($internal)
        {
            $form = $this->content->addForm($form, true, $this->getKey());
            $this->extra[$form->getKey()] = $form;
        }
        else
            $form = $this->content->addForm($form, false, $this->getKey());

        return $form;
    }

    public function buttons()
    {
        $buttons = Buttons::getInstance();

        $this->buttons = $buttons;
        return $buttons;
    }

    public function addExtra($key, $value)
    {
        $this->extra[$key] = $value;
    }
}