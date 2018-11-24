{# form_numeric(field, style) #}
{% set class = 'ilya-form-'~ style ~'-number' %}
{{ field.render(['class': class]) }}
{#<input {{ field['tags'] }} type="text" value="{{ field['value'] }}" class="ilya-form-{{ style }}-number"/>#}