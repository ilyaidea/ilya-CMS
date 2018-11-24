{# form-fields(form) #}

{% if form.elements.hasField() %}
    {% for key, field in form.elements.getFields() %}
        {{ helper.setContext('field_key', key) }}

        {% if (field.getAttributes('type') !== null ) and (field.getAttributes('type') === 'blank') %}
            {#{{ partial('form-spacer', ['form':form, 'columns': columns]) }}#}
        {% else %}
            {{ partial('form-field-rows', ['form':form, 'field': field]) }}
        {% endif %}
    {% endfor %}

    {{ helper.clearContext('field_key') }}
{% endif %}