{# form_static(field, style) #}
{% set class = 'ilya-form-'~ style ~'-static' %}
{{ field.render(['class': class]) }}
{#<span class="ilya-form-{{ style }}-static">{{ field['value'] }}</span>#}