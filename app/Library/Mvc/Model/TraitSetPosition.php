<?php
/**
 * Created by PhpStorm.
 * User: Saeed
 * Date: 12/24/2018
 * Time: 11:07 AM
 */

namespace Lib\Mvc\Model;


use Phalcon\Mvc\Collection\Manager;

trait TraitSetPosition
{
    public function sortByPosition($update = false)
    {
        if (!method_exists($this,'setPosition'))
            return;



        /** @var \Phalcon\Mvc\Model\Manager $modelManager */
        $modelManager = $this->getModelsManager();

        $result = $modelManager->createBuilder();
        $result->columns(['id', 'position']);
        $result->from(get_class($this));

        if(method_exists($this,'getParentId'))
        {
            if($this->getParentId())
                $result->where('parent_id=:p:', ['p' => $this->getParentId()]);
            else
                $result->where('parent_id IS NULL');
        }
        if(method_exists($this,'getCourseId'))
        {
            if($this->getCourseId())
                $result->andWhere('course_id=:c:', ['c' => $this->getCourseId()]);
            else
                $result->andWhere('course_id IS NULL');
        }

        if(method_exists($this,'getlanguage'))
        {
            $result->andWhere('language=:lang:', ['lang' => $this->getLanguage()]);
        }

        if($this->create_mode)
            $result->orderBy('position ASC,created_at DESC');
        else
            $result->orderBy('position ASC,modified_in DESC');

        $result = $result->getQuery()->execute();
//        dump($result->toArray());

        $i = 1;
        foreach($result as $res)
        {
            $class = get_class($this);

            $course = $class::findFirst($res->id);
//            dump($course->toArray());
//            $course->setTransaction($this->getTransaction());

            $course->setPosition($i);

            if(!$course->update())
            {
                foreach($course->getMessages() as $message)
                {
//                    $this->getTransaction()->rollback(
//                        $message->getMessage()
//                    );
                }
            }
            $i++;
        }

    }

    protected function setPositionIfEmpty()
    {
        /** @var \Phalcon\Mvc\Model\Manager $modelManager */
        $modelManager = $this->getModelsManager();

        $position = $modelManager->createBuilder();

        $position->columns('MAX(position) AS max');
        $position->from(get_class($this));

        if(method_exists($this,'getParentId'))
        {
            if($this->getParentId())
                $position->where('parent_id=:p:', ['p' => $this->getParentId()]);
            else
                $position->where('parent_id IS NULL');
        }


        if($this->getId())
            $position->andWhere('id <> :id:', ['id' => $this->getId()]);

        if(method_exists($this,'getlanguage'))
        {
            $position->andWhere('language=:lang:', ['lang' => $this->getLanguage()]);
        }

        $position = $position->getQuery()->getSingleResult();

        $this->setPosition(1);
        if($position->max)
            $this->setPosition($position->max + 1);
    }
}