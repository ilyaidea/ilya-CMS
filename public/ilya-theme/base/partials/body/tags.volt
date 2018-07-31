{% set class = 'ilya-template-' ~ helper.html(helper.template) %}
{% set class = class ~ ((helper.theme is empty) ? '' : 'ilya-theme-' ~ helper.html(helper.theme)) %}

{% if helper.content['category_ids'] is defined %}
    {% for category_ids in helper.content['category_ids'] %}
        {% set class = class ~ ' ilya-category-' ~ helper.html(category_ids) %}
    {% endfor %}
{% endif %}

{{ helper.output(' class="' ~ class ~ ' ilya-body-js-off"') }}