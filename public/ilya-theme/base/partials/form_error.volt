{# form_ok(form, columns) #}
{% if form['error'] is not empty %}
    <tr>
        <td colspan="{{ columns }}" class="ilya-error">
            {{ form['error'] }}
        </td>
    </tr>
{% endif %}