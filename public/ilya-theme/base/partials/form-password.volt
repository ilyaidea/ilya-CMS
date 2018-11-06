{# form_password(field, style) #}
{% set class = 'ilya-form-'~ style ~'-text' %}
{{ field.render(['class': class]) }}
{#<input {{ field['tags'] }} type="password" value="{{ field['value'] }}" class="ilya-form-{{ style }}-text"/>#}