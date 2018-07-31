{% if hidden is not empty %}
    {% for name, value in hidden %}
        {% if is_array(value) %}
            {# new method of outputting tags #}
            <input {{ value['tags'] }} type="hidden" value="{{ value['value'] }}"/>
        {% else %}
            <input name="{{ name }}" type="hidden" value="{{ value }}"/>
        {% endif %}
    {% endfor %}
{% endif %}