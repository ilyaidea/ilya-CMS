{# form-week(field, style) #}
{% set class = 'ilya-form-'~ style ~'-week' %}
{{ field.render(['class': class]) }}