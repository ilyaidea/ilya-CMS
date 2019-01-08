{# form/alerts/notice(form) #}
{% if messages['notice'][form.prefix] is defined %}
    {% if messages['notice'][form.prefix] is iterable %}
        {% for notice in messages['notice'][form.prefix] %}
            <tr>
                <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-notice">
                    {{ notice }}
                </td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-notice">
                {{ messages['notice'][form.prefix] }}
            </td>
        </tr>
    {% endif %}
{% endif %}