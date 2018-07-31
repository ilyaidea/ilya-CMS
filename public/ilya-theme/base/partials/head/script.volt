{% if helper.content['script'] is defined %}
    {% for script_line in helper.content['script'] %}
        {{ helper.output_raw(script_line) }}
    {% endfor %}
{% endif %}