{{ helper.doctype() }}
<html>
<head>
    <title>{{ helper.title().get() }}</title>

    {% block metas %}
        {{ helper.meta().get('description') }}
        {{ helper.meta().get('keywords') }}
        {{ helper.meta().get('seo-manager') }}
    {% endblock %}

    {% block favicon %}
        {% if file_exists(url.path()~'favicon.ico') is true %}
            <link href="{{ url.get() }}favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        {% endif %}
    {% endblock %}

    {{ assets.outputCss() }}
</head>
<body>
{{ content() }}

{{ assets.outputJs() }}
</body>
</html>