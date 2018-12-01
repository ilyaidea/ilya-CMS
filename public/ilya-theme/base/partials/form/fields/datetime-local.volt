{# form-datetime-local(field, style) #}
{% set class = 'ilya-form-'~ style ~'-datetime-local' %}
{{ field.render(['class': class]) }}