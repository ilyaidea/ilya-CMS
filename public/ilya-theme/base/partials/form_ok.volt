{# form_ok(form, columns) #}
{% if form['ok'] is not empty %}
    <tr>
        <td colspan="{{ columns }}" class="ilya-form-{{ form['style'] }}-ok">
            {{ form['ok'] }}
        </td>
    </tr>
{% endif %}