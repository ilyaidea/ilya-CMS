{# form_text_multi_row(field, style) #}
{% set class = 'ilya-form-'~ style ~'-text' %}
{{ field.render(['class':class]) }}
{#<input {{ (field['tags'] is defined) ? field['tags'] : '' }} type="text" value="{{ field['value'] }}" class="ilya-form-{{ style }}-text"/>#}