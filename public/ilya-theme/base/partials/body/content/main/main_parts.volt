{{ content() }}
{% for key, part in helper.content().get() %}
    {{ helper.setContext('part', key) }}

    {{ partial('body/content/main/main_part', ['key': key, 'part': part]) }}
{% endfor %}

{{ helper.clearContext('part') }}