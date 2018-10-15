{# form_buttons(form, columns) #}
{% if form['buttons'] is not empty %}
    {% set style = (form['style'] is defined) ? form['style'] : null %}

    {% if columns is true %}
        <tr>
        <td colspan="{{ columns }}" class="ilya-form-{{ style }}-buttons">
    {% endif %}

    {% for key, button in form['buttons'] %}
        {{ helper.setContext('button_key', key) }}

        {% if button is empty %}
            {{ partial('form/button_spacer', ['style': style]) }}
        {% else %}
            {{ partial('form/button_data', ['button':button, 'key':key, 'style': style]) }}
            {{ partial('form/button_note', ['button':button, 'style': style]) }}
        {% endif %}
    {% endfor %}

    {{ helper.clearContext('button_key') }}

    {% if columns is true %}
        </td>
            </tr>
    {% endif %}
{% endif %}