{{ content() }}
{% if content is not empty %}
    {% for key, part in content %}
        {{ helper.setContext('part', key) }}

        {{ partial('main-part', ['key': key, 'part': part]) }}
    {% endfor %}

    {{ helper.clearContext('part') }}
{% endif %}