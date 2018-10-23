{# form_ok(form, columns) #}
{% if form['error'] is not empty %}
    <tr>
        <td colspan="{{ columns }}" class="ilya-form-error">
            {{ form['error'] }}
        </td>
    </tr>
{% endif %}