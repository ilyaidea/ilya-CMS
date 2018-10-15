{# form_checkbox(field, style) #}
<input {{ field['tags'] }} type="checkbox" value="1"{{ (field['value']) ? 'checked' : '' }} class="ilya-form-{{ style }}-checkbox"/>