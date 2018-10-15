{# form_note(field, style, columns) #}
{% set tag = (columns > 1) ? 'span' : 'div' %}

<{{ tag }} class="ilya-form-{{ style }}-note">{{ (field['note'] is defined) ? field['note'] : '' }}</{{ tag }}>