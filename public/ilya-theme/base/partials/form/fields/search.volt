{# form-search(field, style) #}
{% set class = 'ilya-form-'~ style ~'-search' %}
{{ field.render(['class': class]) }}