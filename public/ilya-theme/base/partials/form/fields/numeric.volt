{# form_numeric(field, style) #}
{% set class = 'ilya-form-'~ style ~'-number' %}
{{ field.render(['class': class]) }}