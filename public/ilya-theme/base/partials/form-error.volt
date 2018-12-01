{# form-error(form) #}
{% if messages['error'][form.prefix] is defined %}
    {% if messages['error'][form.prefix] is iterable %}
        {% for error in messages['error'][form.prefix] %}
            <tr>
                <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-error">
                    {{ error }}
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-error">
                {{ messages['error'][form.prefix] }}
            </td>
        </tr>
    {% endif %}
{% endif %}