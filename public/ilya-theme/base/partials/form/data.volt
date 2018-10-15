{# form_data(field, style, columns, showfield, colspan) #}

{% if (showfield is true) or (field['error'] is not empty) or (field['note'] is not empty) %}
    <td class="ilya-form-{{ style }}-data"{{ (colspan is defined) ? ' colspan="'~ colspan~ '"' : '' }}>
        {% if showfield is true %}
            {{ partial('form/field', ['field':field, 'style': style]) }}
        {% endif %}

        {% if field['error'] is not empty %}
            {% if field['note_force'] is defined %}
                {{ partial('form/note', ['field':field, 'style': style, 'columns': columns]) }}
            {% endif %}

            {{ partial('form/field_error', ['field':field, 'style': style, 'columns': columns]) }}
        {% elseif field['note'] is not empty %}
            {{ partial('form/note', ['field':field, 'style': style, 'columns': columns]) }}
        {% endif %}
    </td>
{% endif %}