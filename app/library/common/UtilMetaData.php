<?php
/**
 * Summary File UtilMetaData
 *
 * Description File UtilMetaData
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 5/23/2018
 * Time: 4:53 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Common;


class UtilMetaData
{
    const METADATA_FILE_JSON = 'metadata.json';

    /**
     * Fetch metadata information from an addon path
     * @param string $path Directory the addon is in (without trailing slash)
     * @return array The metadata fetched from the JSON file, or an empty array otherwise
     */
    public function fetchFromAddonPath($path)
    {
        $metadataFile = $path . '/' . self::METADATA_FILE_JSON;
        if (!is_file($metadataFile)) {
            return array();
        }

        $content = file_get_contents($metadataFile);
        return $this->getArrayFromJson($content);
    }

    /**
     * Fetch metadata information from an URL
     * @param string $url URL linking to a metadata.json file
     * @return array The metadata fetched from the file
     */
    public function fetchFromUrl($url, $type = 'Plugin')
    {
        $contents = ilya_retrieve_url($url);
        $metadata = $this->getArrayFromJson($contents);

        // fall back to old metadata format
        if (empty($metadata)) {
            $metadata = ilya_addon_metadata($contents, $type);
        }

        return $metadata;
    }

    /**
     * Return an array from a JSON string
     * @param mixed $json The JSON string to turn into an array
     * @return array Always return an array containing the decoded JSON or an empty array in case the
     * $json parameter is not a valid JSON string
     */
    private function getArrayFromJson($json)
    {
        $result = json_decode($json, true);
        return is_array($result) ? $result : array();
    }

    function AddonMetadata($contents, $type, $versiononly = false)
    {
        $fields = array(
            'min_q2a' => 'Minimum Question2Answer Version',
            'min_php' => 'Minimum PHP Version',
        );
        if (!$versiononly) {
            $fields = array_merge($fields, $fields = array(
                'name' => 'Name',
                'uri' => 'URI',
                'description' => 'Description',
                'version' => 'Version',
                'date' => 'Date',
                'author' => 'Author',
                'author_uri' => 'Author URI',
                'license' => 'License',
                'update_uri' => 'Update Check URI',
            ));
        }

        $metadata = array();
        foreach ($fields as $key => $field) {
            // prepend 'Theme'/'Plugin' and search for key data
            $fieldregex = str_replace(' ', '[ \t]*', preg_quote("$type $field", '/'));
            if (preg_match('/' . $fieldregex . ':[ \t]*([^\n\f]*)[\n\f]/i', $contents, $matches))
                $metadata[$key] = trim($matches[1]);
        }

        return $metadata;
    }
}