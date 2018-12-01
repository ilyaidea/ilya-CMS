{# form-range(field, style) #}
{% set class = 'ilya-form-'~ style ~'-range' %}
{{ field.render(['class': class]) }}