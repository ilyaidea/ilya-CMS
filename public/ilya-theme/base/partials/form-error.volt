{# form-error(form) #}

{% if form.validate.hasError() %}
    <tr>
        <td colspan="{{ form.design.getColumns() }}" class="ilya-form-{{ form.design.getStyle() }}-error">
            {{ form.validate.getErrorMsg() }}
        </td>
    </tr>
{% endif %}