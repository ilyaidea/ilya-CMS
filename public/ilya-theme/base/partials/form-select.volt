{# form_select(field, style) #}
<select {{ ((field['tags'] is defined) ? field['tags'] : '') }} class="ilya-form-{{ style }}-select">

    {% set matchbykey = (field['match_by'] is defined) and field['match_by'] === 'key' %}

    {% for key, value in field['options'] %}
        {% set selected = (field['value'] is defined) and (
                (matchbykey and key == field['value']) or
                ((matchbykey is false) and value == field['value'])
            ) %}

        <option value="{{ key }}" {{ (selected ? ' selected' : '') }}>{{ value }}</option>
    {% endfor %}
</select>