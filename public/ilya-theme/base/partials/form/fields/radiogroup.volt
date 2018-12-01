{# form-radiogroup(field, style) #}
{% set class = 'ilya-form-'~ style ~'-radiogroup' %}
{{ field.render(['class': class]) }}