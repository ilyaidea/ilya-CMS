{# form_note(note, style, columns) #}
{% set tag = (columns > 1) ? 'span' : 'div' %}

<{{ tag }} class="ilya-form-{{ style }}-note">{{ note }}</{{ tag }}>