{# form/alerts/success(form) #}
{% if messages['success'][form.prefix] is defined %}
    {% if messages['success'][form.prefix] is iterable %}
        {% for success in messages['success'][form.prefix] %}
            <tr>
                <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-ok">
                    {{ success }}
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-ok">
                {{ messages['success'][form.prefix] }}
            </td>
        </tr>
    {% endif %}
{% endif %}