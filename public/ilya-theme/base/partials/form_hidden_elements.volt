{# form_hidden_elements(hidden) #}
{% if hidden is not empty %}
    {% for name, value in hidden %}
        {% if is_array(value) %}
            <input {{ ((value['tags'] is defined) ? value['tags'] : '') }} type="hidden" value="{{ ((value['value'] is defined) ? value['value'] : '') }}"/>
        {% else %}
            <input name="{{ name }}" type="hidden" value="{{ value }}"/>
        {% endif %}
    {% endfor %}
{% endif %}