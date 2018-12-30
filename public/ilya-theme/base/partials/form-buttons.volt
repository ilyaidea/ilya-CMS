{# form_buttons(form, columns) #}
{% if form.elements.hasButton() is true %}
    {% set style = (form.design.getStyle() !== null) ? form.design.getStyle() : null %}

    {% if form.design.getColumns() is true %}
        <tr>
            <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ style }}-buttons">
    {% endif %}

    {% for button in form.elements.getButtons() %}
        {{ helper.setContext('button_key', key) }}

        {% if button is empty %}
            {{ partial('form-button-spacer', ['style': style]) }}
        {% else %}
            {{ partial('form-button-data', ['button':button, 'style': style]) }}
            {{ partial('form-button-note', ['button':button, 'style': style]) }}
        {% endif %}
    {% endfor %}

    {{ helper.clearContext('button_key') }}

    {% if form.design.getColumns() is true %}
            </td>
        </tr>
    {% endif %}
{% endif %}