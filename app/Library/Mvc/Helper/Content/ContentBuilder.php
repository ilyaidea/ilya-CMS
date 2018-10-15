<?php
/**
 * Summary File ContentBuilder
 *
 * Description File ContentBuilder
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/10/2018
 * Time: 3:56 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper\Content;


use Lib\Mvc\Helper\Content\Parts\Content;
use Lib\Mvc\Helper\Content\Parts\Form;
use Lib\Mvc\Helper\Content\Parts\FormTall;
use Lib\Mvc\Helper\Content\Parts\FormWide;
use Phalcon\Text;

class ContentBuilder implements IContentBuilder
{
    /**
     * @var Content
     */
    private static $content;
    private static $formKey = 'form';
    private static $listKey = 'list';

    /**
     * @var ContentBuilder
     */
    private static $instance;

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$content = new Content();
            self::$instance = new ContentBuilder();
        }

        return self::$instance;
    }

    public function addFormWide( \Lib\Forms\Form $form )
    {
        self::$formKey = Text::increment(self::$formKey);

        $form = new FormWide($form, self::$formKey);
        self::$content->setParts(self::$formKey, $form->toArray());
        return $form;
    }

    public function addFormTall( \Lib\Forms\Form $form )
    {
        self::$formKey = Text::increment(self::$formKey);

        $form = new FormTall($form, self::$formKey);
        self::$content->setParts(self::$formKey, $form->toArray());
        return $form;
    }

    public function addList( \Lib\Forms\Form $form )
    {
        self::$listKey = Text::increment(self::$listKey);

        self::$content->setParts(self::$listKey, new Form($form));
    }

    public function getContent()
    {
        return self::$content;
    }
}