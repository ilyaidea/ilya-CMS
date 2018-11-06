{# form_prefix(field, style) #}
{% if field.getUserOption('prefix') is not empty %}
    <span class="ilya-form-{{ style }}-prefix">{{ field.getUserOption('prefix') }}</span>
{% endif %}