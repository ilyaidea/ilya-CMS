{{ helper.output('<link rel="stylesheet" href="' ~ helper.rooturl ~ helper.cssName() ~ '"/>') }}

{% if helper.content['css_src'] is defined %}
    {% for css_src in helper.content['css_src'] %}
        {{ helper.output('<link rel="stylesheet" href="' ~ css_src ~ '"/>') }}
    {% endfor %}
{% endif %}

{% if helper.content['notices'] is not empty %}
    {{ helper.output(
        '<style>',
        '.ilya-body-js-on .ilya-notice {display:none;}',
        '</style>'
    ) }}
{% endif %}