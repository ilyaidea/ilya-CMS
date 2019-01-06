<?php
/**
 * Summary File Tag
 *
 * Description File Tag
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 12/1/2018
 * Time: 8:20 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib;


use Lib\Tag\TraitTagHead;
use Lib\Tag\TraitTagHtml;

class Tag extends \Phalcon\Tag
{
    use TraitTagHtml;
    use TraitTagHead;

    public static function staticField( $parameters )
    {
        return "<div>Static field</div>";
    }

    public static function fileUploaderField( $parameters )
    {
        $btn_render = self::fileField( $parameters );
        $html = /** @lang HTML */
            "
<div class='row fileupload-buttonbar'>
    <div class='col-lg-12'>
        <span class='btn btn-success fileinput-button'>
            <i class='glyphicon glyphicon-plus'></i>
            <span>Add files...</span>
            $btn_render
        </span>
        <button type='submit' class='btn btn-primary start'>
            <i class='glyphicon glyphicon-upload'></i>
            <span>Start upload</span>
        </button>
        <button type='reset' class='btn btn-warning cancel'>
            <i class='glyphicon glyphicon-ban-circle'></i>
            <span>Cancel upload</span>
        </button>
        <button type='button' class='btn btn-danger delete'>
            <i class='glyphicon glyphicon-trash'></i>
            <span>Delete</span>
        </button>
        <input type='checkbox' class='toggle'>
                <!-- The global file processing state -->
        <span class='fileupload-process'></span>
    </div>
    <!-- The global progress state -->
    <div class='col-lg-5 fileupload-progress fade'>
        <!-- The global progress bar -->
        <div class='progress progress-striped active' role='progressbar' aria-valuemin='0' aria-valuemax='100'>
            <div class='progress-bar progress-bar-success' style='width:0%;'></div>
        </div>
        <!-- The extended global progress state -->
        <div class='progress-extended'>&nbsp;</div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role='presentation' class='table table-striped'><tbody class='files'></tbody></table>
</div>

<!-- The template to display files available for upload -->
<script id=\"template-upload\" type=\"text/x-tmpl\">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class=\"template-upload fade\">
        <td>
            <span class=\"preview\"></span>
        </td>
        <td>
            <p class=\"name\">{%=file.name%}</p>
            <strong class=\"error text-danger\"></strong>
        </td>
        <td>
            <p class=\"size\">Processing...</p>
            <div class=\"progress progress-striped active\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\" aria-valuenow=\"0\"><div class=\"progress-bar progress-bar-success\" style=\"width:0%;\"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class=\"btn btn-primary start\" disabled>
                    <i class=\"glyphicon glyphicon-upload\"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class=\"btn btn-warning cancel\">
                    <i class=\"glyphicon glyphicon-ban-circle\"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id=\"template-download\" type=\"text/x-tmpl\">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class=\"template-download fade\">
        <td>
            <span class=\"preview\">
                {% if (file.thumbnailUrl) { %}
                    <a href=\"{%=file.url%}\" title=\"{%=file.name%}\" download=\"{%=file.name%}\" data-gallery><img src=\"{%=file.thumbnailUrl%}\"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class=\"name\">
                {% if (file.url) { %}
                    <a href=\"{%=file.url%}\" title=\"{%=file.name%}\" download=\"{%=file.name%}\" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class=\"label label-danger\">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class=\"size\">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class=\"btn btn-danger delete\" data-type=\"{%=file.deleteType%}\" data-url=\"{%=file.deleteUrl%}\"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{\"withCredentials\":true}'{% } %}>
                    <i class=\"glyphicon glyphicon-trash\"></i>
                    <span>Delete</span>
                </button>
                <input type=\"checkbox\" name=\"delete\" value=\"1\" class=\"toggle\">
            {% } else { %}
                <button class=\"btn btn-warning cancel\">
                    <i class=\"glyphicon glyphicon-ban-circle\"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
";

        return $html;
    }

    public static function submitButton( $parameters )
    {

		$params = [];

		if(!is_array($parameters))
        {
            $params[] = $parameters;
        }
        else
        {
            $params = $parameters;
        }

        if ($params["label"])
        {
            $params["value"] = $params["label"];
            unset($params['label']);
        }
        else
            $params['value'] = $params[0];

		$params['type'] = 'submit';
        $code = self::renderAttributes("<input", $params);

		/**
         * Check if Doctype is XHTML
         */
		if (self::$_documentType > self::HTML5) {
            $code .= " />";
		} else {
            $code .= ">";
		}

		return $code;
    }
}