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
use Lib\Mvc\Controller;
use Lib\Mvc\DefaultRouter;
use Lib\Mvc\Model;
use Phalcon\Di;
use Phalcon\Http\Request;
use Phalcon\Mvc\Router\Route;

class ModelPages extends Model implements IModelEvents
{
    use TraitPropertiesPagesModel;
    use TraitRelationsPagesModel;
    use TraitEventsPagesModel;
    use TraitValidationsPagesModel;

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Initialize Method
     */

    public function init()
    {
        $this->setSource('ilya_pages');
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Public Methods
     */

    public function findRoutesBySlug()
    {
        $allRoutes = $this->getDI()->getShared('router')->getRoutes();
        //dump($allRoutes);

        $i = false;
        /** @var Route $value */
        foreach ($allRoutes as $key => $value)
        {
            if($value->getName())
            {
                $slug = explode('__',$value->getName());
                if (in_array($this->getSlug(),$slug))
                {
//                    dump($slug);
                    $i = true;
                    throw new \Exception('The slug already exists in routs, Try another one');
//                    $this->getDI()->getShared('flash')->error('The slug already exists in routs, Try another one');
                }
            }
        }

        if ($i == false)
            $this->setSlug(str_replace(' ', '-', $this->getSlug()));

    }

    public function createPageForRequest(Controller $controller)
    {
        $this->setParentId($controller->getParentIdFromGetRequest());
        $this->setTitle($controller->request->getPost('title'));
        $this->setSlug($controller->request->getPost('slug'));
        $this->setContent($controller->request->getPost('content'));
        $this->setLanguage($controller->request->getPost('language'));
        $this->setPosition($controller->request->getPost('position'));

        if (!$this->save())
        {
            $this->appendMessage('There is a problem in the process of storing the page !');
            return false;
        }
        else
        {
            $this->sortByPosition();
            return true;
        }
    }

    public function updatePageForRequest(Controller $controller)
    {
        $this->setTitle($controller->request->getPost('title'));
        $this->setSlug($controller->request->getPost('slug'));
        $this->setContent($controller->request->getPost('content'));
        $this->setLanguage($controller->request->getPost('language'));
        $this->setPosition($controller->request->getPost('position'));

        if (!$this->update())
        {
            $this->appendMessage('There is a problem in the process of storing the page !');
            return false;
        }
        else
        {
            $this->sortByPosition();
            return true;
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Public static Methods
     */


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

    public static function positionOptions( $lang = 'en', $parent = null, $editId = null)
    {
        $modelManager = ( new self() )->getModelsManager();

        $result = $modelManager->createBuilder();

        $result->columns(['id', 'title', 'position']);
        $result->from(self::class);

        $result->where('language=:lang:', ['lang' => $lang]);

        if($parent)
            $result->andWhere('parent_id=:p:', ['p' => $parent]);
        else
            $result->andWhere('parent_id IS NULL');

        $result->orderBy('position');

        $result = $result->getQuery()->execute();

        $positionOptions = [];
        $previous = null;
        $passedself = false;
        $current = null;

        foreach($result as $value)
        {
            if($value->id == $editId)
            {
                $passedself = true;
            }

            if(!$previous)
                $positionHtml = 'First';
            else
            {
                if($passedself)
                {
                    $positionHtml = 'Current location';
                    $value->current = true;
                }
                else
                    $positionHtml = 'After '. $previous->title;
            }

            if($previous && isset($previous->current) && $previous->current == true)
                $current = $value->position;

            $positionOptions[$value->position] = $positionHtml;

            $previous = $value;
            $passedself = false;
        }

        $positionvalue = isset($previous) ? 'After '. $previous->title : "First";
        $positionOptions[1 + @max(array_keys($positionOptions))] = $positionvalue;

        if($current)
            unset($positionOptions[$current]);

        return $positionOptions;
    }

}