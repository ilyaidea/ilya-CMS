{# form_file(field, style) #}
{% set class = 'ilya-form-'~ style ~'-file' %}
{{ field.render(['class': class]) }}
{#<input {{ field['tags'] }} type="file" class="ilya-form-{{ style }}-file"/>#}