{# form_fields(form, columns) #}
{% if form['fields'] is not empty %}
    {% for key, field in form['fields'] %}
        {{ helper.setContext('field_key', key) }}

        {% if (field['type'] is defined) and (field['type'] === 'blank') %}
            {{ partial('form/spacer', ['form':form, 'columns': columns]) }}
        {% else %}
            {{ partial('form/field_rows', ['form':form, 'columns': columns, 'field': field]) }}
        {% endif %}
    {% endfor %}

    {{ helper.clearContext('field_key') }}
{% endif %}