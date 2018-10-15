<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/12/2018
 * Time: 1:50 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms;

use Lib\Forms\Element\Hidden;
use Phalcon\Security;
use Phalcon\Validation\Validator\Identical;

class Form extends \Phalcon\Forms\Form
{
    private $titleInfo = [];
    private $token;

    public function __construct ( $entity = null, array $userOptions = null )
    {
        parent::__construct( $entity, $userOptions );

        $action = new Hidden('action', [
            'value' => $this->security->hash(get_class($this))
        ]);
        $this->add($action);

        $csrf = new Hidden('csrf', [
            'value' => $this->getToken()
        ]);
        $csrf->addValidator(
            new Identical(
                [
                    'value' => $this->security->getSessionToken(),
                    'message' => ':field validation failed'
                ]
            )
        );
        $csrf->clear();
        $this->add($csrf);
    }

    public function setTitleForm($title, $tags = [])
    {
        if($title)
        {
            $this->titleInfo['title'] = $title;

            if(!empty($tags))
            {
                $this->titleInfo['title_tags'] = $tags;
            }
        }
    }

    public function getTitleForm()
    {
        return @$this->titleInfo['title'];
    }
    public function getTitleTags()
    {
        return @$this->titleInfo['title_tags'];
    }

    public function getToken()
    {
        if(!$this->security->getSessionToken())
        {
            return $this->security->getToken();
        }
        else
        {
            return $this->security->getSessionToken();
        }
    }
}