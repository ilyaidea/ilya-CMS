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

namespace Lib\Contents\Classes;


use Lib\Contents\ContentBuilder;
use Lib\Mvc\Helper;
use Phalcon\Mvc\User\Component;

/**
 * @property Helper helper
 */
class Theme extends Component
{
    /** @var ContentBuilder $content */
    private $content;

    private $sideLeft  = true;
    private $sideRight = true;
    private $sideMain  = true;

    public function __construct(ContentBuilder $contentBuilder)
    {
        $this->content = $contentBuilder;
    }

    public function viewMasterPage()
    {
        $this->sideLeft  = true;
        $this->sideRight = true;
        $this->sideMain  = true;

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

        $this->content->assets->addCss($css);
    }

    public function noLeftMasterPage($fill = true)
    {
        $this->sideLeft  = false;
        $this->sideRight = true;
        $this->sideMain  = true;

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

            if($this->helper->locale()->getDirection() == 'ltr')
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

            $this->content->assets->addCss($css);
        }
    }

    public function noRightMasterPage($fill = true)
    {
        $this->sideLeft  = true;
        $this->sideRight = false;
        $this->sideMain  = true;

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

            $this->content->assets->addCss($css);
        }
    }

    public function noLeftRightMasterPage($fill = true)
    {
        $this->sideLeft  = false;
        $this->sideRight = false;
        $this->sideMain  = true;

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
            $this->content->assets->addCss($css);
        }
    }

    public function hasLeftSide()
    {
        return $this->sideLeft;
    }

    public function hasRightSide()
    {
        return $this->sideRight;
    }

    public function hasMainSide()
    {
        return $this->sideMain;
    }

}