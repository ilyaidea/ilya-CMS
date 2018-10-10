{# form_label(field, style, columns, prefixed, suffixed, colspan) #}
{% set extratags = '' %}

{% if (columns > 1) and ( ((field['type'] is defined) and (field['type'] === 'radio')) or ((field['rows'] is defined) and (field['rows'] > 1))) %}
    {% set extratags = extratags ~ ' style="vertical-align:top;"' %}
{% endif %}

{% if colspan is defined %}
    {% set extratags = extratags ~ '  colspan="'~colspan~'"' %}
{% endif %}

<td class="ilya-form-{{ style }}-label"{{ extratags }}>

{% if prefixed is true %}
    <label>
    {{ partial('form_field', ['field': field, 'style': style]) }}
{% endif %}

{{ (field['label'] is defined) ? field['label'] : null }}

{% if prefixed is true %}
    </label>
{% endif %}

{% if suffixed is true %}
    {{ partial('form_field', ['field': field, 'style': style]) }}
{% endif %}
</td>