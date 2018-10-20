{% if helper.content['body_footer'] is defined %}
    {{ helper.output_raw(helper.content['body_footer']) }}
{% endif %}