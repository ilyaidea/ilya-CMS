{# form_error(field, style, columns) #}
{% set tag = (columns > 1) ? 'span' : 'div' %}

<{{ tag }} class="ilya-field-{{ style }}-error">{{ msg.getMessage() }}</{{ tag }}>