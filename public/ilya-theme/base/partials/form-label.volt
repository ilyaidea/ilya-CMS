{# form_label(field, style, columns) #}
{% set extratags = '' %}

{% if
    (columns > 1)
    and
    ( ((field.getAttributes('type') !== null) and (field.getAttributes('type') === 'radio')) or ((field.getUserOption('rows') !== null) and (field.getUserOption('rows') > 1)))
%}
    {% set extratags = extratags ~ ' style="vertical-align:top;"' %}
{% endif %}

{% if field.design.getColspan() !== null %}
    {% set extratags = extratags ~ '  colspan="'~field.design.getColspan()~'"' %}
{% endif %}

<td class="ilya-form-{{ style }}-label"{{ extratags }}>

{% if field.design.prefixed() is true %}
    <label>
    {{ partial('form-field', ['field': field, 'style': style]) }}
{% endif %}

{{ (field.getLabel() is not null) ? field.getLabel() : null }}

{% if field.design.prefixed() is true %}
    </label>
{% endif %}

{% if field.design.suffixed() is true %}
    &nbsp;
    {{ partial('form-field', ['field': field, 'style': style]) }}
{% endif %}
</td>