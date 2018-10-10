<head>
    {{ partial('head_title') }}
    <link rel="stylesheet" href="{{ static_url('ilya-theme/base/assets/css/styles.css') }}">

    {% if helper.isRTL() is true %}
        <link rel="stylesheet" href="{{ static_url('ilya-theme/base/assets/css/styles-rtl.css') }}">
    {% endif %}

    {#{{ partial('head_metas') }}#}
    {#{{ partial('head_css') }}#}
    {#{{ partial('head_links') }}#}
    {#{{ partial('head_lines') }}#}
    {#{{ partial('head_script') }}#}
    {#{{ partial('head_custom') }}#}
</head>