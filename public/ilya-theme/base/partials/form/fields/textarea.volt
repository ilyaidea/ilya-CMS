{# form_text_multi_row(field, style) #}
{% set class = 'ilya-form-'~ style ~'-text' %}
{{ field.render(['class': class]) }}
{#<textarea {{ field['tags'] }} rows="{{ field['rows'] }}" cols="40" class="ilya-form-{{ style }}-text">{{ field['value'] }}</textarea>#}