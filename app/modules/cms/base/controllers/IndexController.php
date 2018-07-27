<?php
/**
 * Ilya CMS Created by PhpStorm.
 * User: projekt
 * Date: 5/8/2018
 * Time: 11:13 AM
 */
namespace Modules\Cms\Base\Controllers;

use Lib\Common\UtilMetaData;
use Lib\Module\ModuleManager;
use Lib\Mvc\Model\Options;
use Phalcon\Assets\Filters\Cssmin;

/**
 * @property \Lib\Mvc\Helper $helper
 * @property \Phalcon\Tag $tag
 */
class IndexController extends \Lib\Mvc\Controller
{
    public function indexAction()
    {
        $this->tag->setTitle("index controller");
        $this->setEnviroment('backend', 'main');

        $this->view->languages_disabled = false;

        $this->addcss();

        $this->addjs();

        $this->setmetas();

    }
    private function addcss()
    {
        $this->assets->addCss('ilya-theme/backend/assets/icon/themify-icons/themify-icons.css');
        $this->assets->addCss('ilya-theme/backend/assets/icon/icofont/css/icofont.css');

        $cssCollection = $this->assets->collection('css_src');
        $cssCollection->setTargetPath('final.css');
        $cssCollection->setTargetUri('final.css');
        $cssCollection->addCss('https://fonts.googleapis.com/css?family=Open+Sans:400,600', false);
        $cssCollection->addCss('ilya-theme/backend/assets/bower_components/bootstrap/css/bootstrap.min.css');
        $cssCollection->addCss('ilya-theme/backend/assets/pages/menu-search/css/component.css');
        $cssCollection->addCss('ilya-theme/backend/assets/css/style.css');
        $cssCollection->addCss('ilya-theme/backend/assets/css/jquery.mCustomScrollbar.css');
        $cssCollection->join(true);
        $cssCollection->addFilter(new Cssmin());
    }
    private function addjs()
    {
        $this->assets->addJs('ilya-theme/backend/assets/bower_components/jquery/js/jquery.min.js');
        $this->assets->addJs('ilya-theme/backend/assets/bower_components/jquery-ui/js/jquery-ui.min.js');
        $this->assets->addJs('ilya-theme/backend/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js');
        $this->assets->addJs('ilya-theme/backend/assets/js/pcoded.min.js');
        $this->assets->addJs('ilya-theme/backend/assets/js/demo-12.js');
        $this->assets->addJs('ilya-theme/backend/assets/js/jquery.mCustomScrollbar.concat.min.js');
        $this->assets->addJs('ilya-theme/backend/assets/js/script.min.js');

    }
    private function setmetas()
    {
        $this->helper->meta()->set('description', 'meta description');
        $this->helper->meta()->set('keywords', 'meta keyword');

        $this->helper->title('IlyaCms Admin Panel', true);

        $moduleManager = new ModuleManager();
        $this->helper->sidebarMenu()->set($moduleManager->sortedModuleFiles());
    }
}