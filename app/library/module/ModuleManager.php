<?php
/**
 * Summary File ModuleManager
 *
 * Description File ModuleManager
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/22/2018
 * Time: 7:41 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Module;

use Lib\Common\UtilMetaData;
use Lib\Mvc\Model\Options;

class ModuleManager
{
    const MODULE_DELIMITER = ';';
    const OPT_ENABLED_PLUGINS = 'enabled_modules';

    private $loadBeforeDbInit = array();
    private $loadAfterDbInit = array();

    public function readAllPluginMetadatas()
    {
        $pluginDirectories = $this->getFilesystemPlugins(true);

        foreach ($pluginDirectories as $pluginDirectory) {
            $pluginFile = $pluginDirectory . 'qa-plugin.php';

            if (!file_exists($pluginFile)) {
                continue;
            }

            $metadataUtil = new Q2A_Util_Metadata();
            $metadata = $metadataUtil->fetchFromAddonPath($pluginDirectory);
            if (empty($metadata)) {
                // limit plugin parsing to first 8kB
                $contents = file_get_contents($pluginFile, false, null, 0, 8192);
                $metadata = ilya_addon_metadata($contents, 'Plugin', true);
            }

            // skip plugin which requires a later version of Q2A
            if (isset($metadata['min_q2a']) && ilya_ilya_version_below($metadata['min_q2a'])) {
                continue;
            }
            // skip plugin which requires a later version of PHP
            if (isset($metadata['min_php']) && ilya_php_version_below($metadata['min_php'])) {
                continue;
            }

            $pluginInfoKey = basename($pluginDirectory);
            $pluginInfo = array(
                'pluginfile' => $pluginFile,
                'directory' => $pluginDirectory,
                'urltoroot' => substr($pluginDirectory, strlen(ILYA_BASE_DIR)),
            );

            if (isset($metadata['load_order'])) {
                switch ($metadata['load_order']) {
                    case 'after_db_init':
                        $this->loadAfterDbInit[$pluginInfoKey] = $pluginInfo;
                        break;
                    case 'before_db_init':
                        $this->loadBeforeDbInit[$pluginInfoKey] = $pluginInfo;
                        break;
                    default:
                }
            } else {
                $this->loadBeforeDbInit[$pluginInfoKey] = $pluginInfo;
            }
        }
    }

    private function loadPlugins($pluginInfos)
    {
        global $ilya_plugin_directory, $ilya_plugin_urltoroot;

        foreach ($pluginInfos as $pluginInfo) {
            $ilya_plugin_directory = $pluginInfo['directory'];
            $ilya_plugin_urltoroot = $pluginInfo['urltoroot'];

            require_once $pluginInfo['pluginfile'];
        }

        $ilya_plugin_directory = null;
        $ilya_plugin_urltoroot = null;
    }

    public function loadPluginsBeforeDbInit()
    {
        $this->loadPlugins($this->loadBeforeDbInit);
    }

    public function loadPluginsAfterDbInit()
    {
        $enabledPlugins = $this->getEnabledPlugins(false);
        $enabledForAfterDbInit = array();

        foreach ($enabledPlugins as $enabledPluginDirectory) {
            if (isset($this->loadAfterDbInit[$enabledPluginDirectory])) {
                $enabledForAfterDbInit[$enabledPluginDirectory] = $this->loadAfterDbInit[$enabledPluginDirectory];
            }
        }

        $this->loadPlugins($enabledForAfterDbInit);
    }

    public function getEnabledPlugins($fullPath = false)
    {
        $moduleDirectories = $this->getEnabledPluginsOption();

        if ($fullPath) {
            foreach ($moduleDirectories as $key => &$pluginDirectory) {
                $pluginDirectory = MODULE_PATH . $pluginDirectory . '/';
            }
        }

        return $moduleDirectories;
    }

    public function setEnabledPlugins($array)
    {
        $this->setEnabledPluginsOption($array);
    }

    public function getFilesystemPlugins($fullPath = false)
    {
        $result = array();

        $fileSystemPluginFiles = glob(MODULE_PATH . '*/*/Module.php');

        foreach ($fileSystemPluginFiles as $pluginFile) {
            $directory = dirname($pluginFile) . '/';

            if (!$fullPath) {
                $directory = basename($directory);
            }
            $result[] = $directory;
        }

        return $result;
    }

    public function getHashesForPlugins($pluginDirectories)
    {
        $result = array();

        foreach ($pluginDirectories as $pluginDirectory) {
            $result[$pluginDirectory] = md5($pluginDirectory);
        }

        return $result;
    }

    private function getEnabledPluginsOption()
    {
        return explode(self::MODULE_DELIMITER, Options::Opt(self::OPT_ENABLED_PLUGINS));
    }

    private function setEnabledPluginsOption($array)
    {
        Options::Opt(self::OPT_ENABLED_PLUGINS, implode(self::MODULE_DELIMITER, $array));
//        ilya_opt(self::OPT_ENABLED_PLUGINS, implode(self::PLUGIN_DELIMITER, $array));
    }

    public function cleanRemovedModules()
    {
        $finalEnabledPlugins = array_intersect(
            $this->getFilesystemPlugins(),
            $this->getEnabledPlugins()
        );

        $this->setEnabledPluginsOption($finalEnabledPlugins);
    }

    public function sortedModuleFiles()
    {
        $this->cleanRemovedModules();

        $filesystemModules = $this->getFilesystemPlugins(true);
        $this->addmoduledirpaths($filesystemModules);

        return [];
    }

    private function addmoduledirpaths($filesystemModules)
    {
        if (!empty($filesystemModules))
        {
            $metadataUtil = new UtilMetaData();
            $sortedModuleFiles = [];

            foreach ($filesystemModules as $moduleDirectoryPath)
            {
                $moduleName = basename($moduleDirectoryPath);
                $moduleCategory = basename(dirname($moduleDirectoryPath));
                $metadata = $metadataUtil->fetchFromAddonPath($moduleDirectoryPath);

                if (empty($metadata))
                {
                    $moduleFile = $moduleDirectoryPath. '/Module.php';

                    // limit plugin parsing to first 8kB
                    $contents = file_get_contents($moduleFile, false, null, 0, 8192);
                    $metadata = $metadataUtil->AddonMetadata($contents, 'Module');
                }

                $sortedModuleFiles['systems_'. $moduleCategory][$moduleName] = $metadata;
            }

            return $sortedModuleFiles;
        }
    }
}
