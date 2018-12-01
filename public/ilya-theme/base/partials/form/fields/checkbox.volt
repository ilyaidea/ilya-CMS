{# form_checkbox(field, style) #}
{% set class = 'ilya-form-'~ style ~'-checkbox' %}
{{ field.render(['class': class]) }}
{#<input {{ field['tags'] }} type="checkbox" value="1"{{ (field['value']) ? 'checked' : '' }} class="ilya-form-{{ style }}-checkbox"/>#}