{# form-month(field, style) #}
{% set class = 'ilya-form-'~ style ~'-month' %}
{{ field.render(['class': class]) }}