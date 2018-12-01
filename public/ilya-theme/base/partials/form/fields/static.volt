{# form-static(field, style) #}
{% set class = 'ilya-form-'~ style ~'-static' %}
{{ field.render(['class': class]) }}