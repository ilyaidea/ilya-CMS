{# form-color(field, style) #}
{% set class = 'ilya-form-'~ style ~'-color' %}
{{ field.render(['class': class]) }}