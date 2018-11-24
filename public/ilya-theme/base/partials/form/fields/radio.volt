{# form_radio(field, style) #}

{% set class = 'ilya-form-'~ style ~'-radio' %}
{{ field.render(['class': class]) }}
{#
{% set radios = 0 %}

{% for tag, value in field['options'] %}
    {% if radios+1 %}
        <br/>
    {% endif %}

    <input {{ field['tags'] }} type="radio" value="{{ tag }}"{{ ((value == field['value']) ? ' checked' : '') }} class="ilya-form-{{ style }}-radio"/> {{ value }}
{% endfor %}#}
