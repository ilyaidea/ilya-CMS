{# form-time(field, style) #}
{% set class = 'ilya-form-'~ style ~'-time' %}
{{ field.render(['class': class]) }}