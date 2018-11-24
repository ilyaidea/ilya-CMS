{# form_data(field, style, columns, showfield, colspan) #}

{% if (showfield is true) or (field.getUserOption('error') !== null) or (field.getUserOption('note') !== null) %}
    <td class="ilya-form-{{ style }}-data"{{ (field.design.getColspan() !== null ) ? ' colspan="'~ field.design.getColspan()~ '"' : '' }}>
        {% if showfield is true %}
            {{ partial('form-field', ['field':field, 'style': style]) }}
        {% endif %}

        {% if field.getMessages().count() !== 0 %}
            {% for msg in field.getMessages() %}
                {{ partial('form-field-error', ['msg':msg, 'style': style, 'columns': columns]) }}
                {% break %}
            {% endfor %}
        {% endif %}

        {% if field.getUserOption('error') !== null %}
            {% if field.getUserOption('note_force') !== null %}
                {{ partial('form-note', ['note':field.getUserOption('note_force'), 'style': style, 'columns': columns]) }}
            {% endif %}

            {{ partial('form-field-error', ['field':field, 'style': style, 'columns': columns]) }}
        {% elseif field.getUserOption('note') is not empty %}
            {{ partial('form-note', ['note':field.getUserOption('note'), 'style': style, 'columns': columns]) }}
        {% endif %}
    </td>
{% endif %}