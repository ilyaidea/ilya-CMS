{# form_prefix(field, style) #}
{% if field['prefix'] is not empty %}
    <span class="ilya-form-{{ style }}-prefix">{{ field['prefix'] }}</span>
{% endif %}