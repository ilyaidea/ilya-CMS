{# form/alerts/warning(form) #}
{% if messages['warning'][form.prefix] is defined %}
    {% if messages['warning'][form.prefix] is iterable %}
        {% for warning in messages['warning'][form.prefix] %}
            <tr>
                <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-warning">
                    {{ warning }}
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-warning">
                {{ messages['warning'][form.prefix] }}
            </td>
        </tr>
    {% endif %}
{% endif %}