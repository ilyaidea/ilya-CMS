{##}
{%- macro body_tags(theme, fixed_topbar)  %}
    {% set class = 'ilya-template-' ~ config.module.name  %}
    {% set class = class~ ' ilya-theme-'~ ((theme is empty) ? '' : helper.html(theme)) %}

    {% if fixed_topbar %}
        {% set class = class~ ' qam-body-fixed' %}
    {% endif %}

    {% return 'class="'~ class~' ilya-body-js-off"' %}
{%- endmacro  %}
