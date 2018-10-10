{# form_text_multi_row(field, style) #}
<input {{ (field['tags'] is defined) ? field['tags'] : '' }} type="text" value="{{ field['value'] }}" class="ilya-form-{{ style }}-text"/>