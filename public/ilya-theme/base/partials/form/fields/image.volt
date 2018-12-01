{# form_image(field, style) #}
{% set class = 'ilya-form-'~ style ~'-image' %}
{{ field.render(['class': class]) }}
{#<div class="ilya-form-{{ style }}-image">{{ field['html'] }}</div>#}