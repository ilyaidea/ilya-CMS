{% if helper.content['head_lines'] is defined %}
    {% for line in helper.content['head_lines'] %}
        {{ helper.output_raw(line) }}
    {% endfor %}
{% endif %}