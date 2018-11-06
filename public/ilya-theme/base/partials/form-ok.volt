{# form-ok(form) #}

{% if form.validate.isOk() %}
    <tr>
        <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-ok">
            {{ form.validate.getOkMsg() }}
        </td>
    </tr>
{% endif %}