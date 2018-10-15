{# form_field_rows(form, columns, field) #}
{% set style = form['style'] %}

{% if form['style'] is defined %}
    {% set style = form['style'] %}
    {% set colspan = columns %}
    {% set columns = (style === 'wide') ? 2 : 1 %}
{% else %}
    {% set colspan = null %}
{% endif %}

{% set prefixed = ((field['type'] is defined) and (field['type'] === 'check')) and (columns === 1) and (field['label'] is not empty) %}
{% set suffixed = ((field['type'] is defined) and (field['type'] === 'select' or field['type'] === 'numeric')) and (columns === 1) and (field['label'] is not empty) and ((field['loose'] is defined) and field['loose'] is not true) %}
{% set skipdata = (field['tight'] is defined) ? field['tight'] : null %}

{% set tworows = (columns === 1) and (field['label'] is not empty) and (skipdata is false) and (( (prefixed or suffixed) is not true ) or (field['error'] is not empty) or (field['note'] is not empty)) %}

{% if field['id'] is defined %}
    {% if columns == 1 %}
        <tbody id="{{ field['id'] }}">', '<tr>
    {% else %}
        <tr id="{{ field['id'] }}">
    {% endif %}
{% else %}
    <tr>
{% endif %}

{% if (columns > 1) or (field['label'] is not empty) %}
    {{ partial('form/label', ['field':field, 'style': style, 'columns': columns, 'prefixed':prefixed, 'suffixed': suffixed, 'colspan': colspan]) }}
{% endif %}

{% if tworows is true %}
    </tr>
    <tr>
{% endif %}

{% if skipdata is false %}
    {% set showfield = (prefixed or suffixed) is not true %}
    {{ partial('form/data', ['field':field, 'style': style, 'columns': columns,'showfield': showfield , 'colspan': colspan]) }}
{% endif %}

    </tr>

{% if (columns === 1) and (field['id'] is defined) %}
    </tbody>
{% endif %}