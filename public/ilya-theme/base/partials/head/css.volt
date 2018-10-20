{% if helper.content().getContent().getParts()['css'] is not empty %}
    {% for css in helper.content().getContent().getParts()['css'] %}
        <link rel="stylesheet" href="{{ css }}">
    {% endfor %}
{% endif %}