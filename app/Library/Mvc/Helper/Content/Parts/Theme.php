<?php
/**
 * Summary File CmsCache
 *
 * Description File CmsCache
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/18/2018
 * Time: 7:01 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Mvc\Helper\Content\Parts;


use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class Theme extends Component
{
    /**
     * @var Theme
     */
    private static $instance = null;

    private static $sideLeft  = true;
    private static $sideRight = true;
    private static $sideMain  = true;

    public static function getInstance()
    {
        if( !self::$instance )
        {
            self::$instance = new Theme();
        }

        return self::$instance;
    }

    public function viewMasterPage()
    {
        self::$sideLeft  = true;
        self::$sideRight = true;
        self::$sideMain  = true;

        $css = /** @lang CSS */
            <<<'TAG'
            @media (min-width: 980px) {
                .ilya-main{
                    width: 50%;
                }
                .ilya-sidepanel-left, .ilya-sidepanel-right {
                    width: 25%;
                }
                .ilya-widgets-main,
                        [class^="ilya-part-form"],
                        [class^="ilya-part-datatable"],
                        [class^="ilya-part-custom"] {
                            margin-right: 5px;
                            margin-left: 5px;
                }
            }
TAG;

        self::$instance->helper->content()->getContent()->addCss($css);
    }

    public function noLeftMasterPage($fill = true)
    {
        self::$sideLeft  = false;
        self::$sideRight = true;
        self::$sideMain  = true;

        if($fill)
        {
            $css = /** @lang CSS */
                <<<'TAG'
                @media (min-width: 980px) {
                    .ilya-main{
                        width: 70%;
                    }
                    .ilya-sidepanel-left, .ilya-sidepanel-right {
                        width: 30%; 
                    }
                }
TAG;

            if(self::$instance->helper->locale()->getDirection() == 'ltr')
            {
                $css .= /** @lang CSS */
                    <<<'TAG'
                    @media (min-width: 980px) {
                        .ilya-widgets-main,
                            [class^="ilya-part-form"],
                            [class^="ilya-part-datatable"],
                            [class^="ilya-part-custom"] {
                                margin-left: auto;
                        }
                    }
TAG;
            }
            else
            {
                $css .= /** @lang CSS */
                    <<<'TAG'
                    @media (min-width: 980px) {
                        .ilya-widgets-main,
                            [class^="ilya-part-form"],
                            [class^="ilya-part-datatable"],
                            [class^="ilya-part-custom"] {
                                margin-right: auto;
                        }
                    }
TAG;
            }

            self::$instance->helper->content()->getContent()->addCss($css);
        }
    }

    public function noRightMasterPage($fill = true)
    {
        self::$sideLeft  = true;
        self::$sideRight = false;
        self::$sideMain  = true;

        if($fill)
        {
            $css = /** @lang CSS */
                <<<'TAG'
                @media (min-width: 980px) {
                    .ilya-main{
                        width: 70%;
                    }
                    .ilya-sidepanel-left, .ilya-sidepanel-right {
                        width: 30%;
                    }
                }
TAG;

            if(self::$instance->helper->locale()->getDirection() == 'ltr')
            {
                $css .= /** @lang CSS */
                    <<<'TAG'
                    @media (min-width: 980px) {
                        .ilya-widgets-main,
                            [class^="ilya-part-form"],
                            [class^="ilya-part-datatable"],
                            [class^="ilya-part-custom"] {
                                margin-right: auto;
                                margin-left: 5px;
                        }
                    }
TAG;
            }
            else
            {
                $css .= /** @lang CSS */
                    <<<'TAG'
                    @media (min-width: 980px) {
                        .ilya-widgets-main,
                            [class^="ilya-part-form"],
                            [class^="ilya-part-datatable"],
                            [class^="ilya-part-custom"] {
                                margin-left: auto;
                                margin-right: 5px;
                        }
                    }
TAG;
            }

            self::$instance->helper->content()->getContent()->addCss($css);
        }
    }

    public function noLeftRightMasterPage($fill = true)
    {
        self::$sideLeft  = false;
        self::$sideRight = false;
        self::$sideMain  = true;

        if($fill)
        {
            $css = /** @lang CSS */
                <<<'TAG'
                @media (min-width: 980px) {
                    .ilya-main{
                        width: 100%;
                    }
                    
                    .ilya-widgets-main,
                        [class^="ilya-part-form"],
                        [class^="ilya-part-datatable"],
                        [class^="ilya-part-custom"] {
                            margin-right: 0;
                            margin-left: 0;
                    }
                }
TAG;
            self::$instance->helper->content()->getContent()->addCss($css);
        }
    }

    public function result()
    {
        return [
            'sideLeft'  => self::$sideLeft,
            'sideRight' => self::$sideRight,
            'sideMain'  => self::$sideMain,
        ];
    }
}