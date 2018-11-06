{# form_field_rows(form, field) #}
{% set style = form.design.getStyle() %}
{% set columns = form.design.getColumns() %}

{% if field.design.getStyle() !== null %}
    {% set style = field.design.getStyle() %}
    {% set columns = field.design.getColumns() %}
{% endif %}

{% if field.getUserOption('id') !== null %}
    {% if field.design.getColumns() == 1 %}
        <tbody id="{{ field.getUserOption('id') }}">', '<tr>
    {% else %}
        <tr id="{{ field.getUserOption('id') }}">
    {% endif %}
{% else %}
    <tr>
{% endif %}

{% if columns > 1 or field.getLabel() is not empty %}
    {{ partial('form-label', ['field': field, 'style': style, 'columns': columns]) }}
{% endif %}

{% if field.design.tworows() %}
        </tr><tr>
{% endif %}

{% if field.getUserOption('skipdata') !== null and field.getUserOption('skipdata') is true %}
{% else %}
    {% set showfield = (field.design.prefixed() is false and field.design.suffixed() is false) %}
    {{ partial('form-data', ['field': field, 'style': style, 'columns': columns, 'showfield': showfield]) }}
{% endif %}

        </tr>

