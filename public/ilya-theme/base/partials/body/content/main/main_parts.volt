{{ content() }}
{% if helper.content().getContent().getParts() is not empty %}
    {% for key, part in helper.content().getContent().getParts() %}
        {{ helper.setContext('part', key) }}

        {{ partial('body/content/main/main_part', ['key': key, 'part': part]) }}
    {% endfor %}

    {{ helper.clearContext('part') }}
{% endif %}