{#{% if helper.content['notices'] is not empty %}#}
    {#{% for notice in helper.content['notices'] %}#}
        {#{{ partial('body/content/notice', ['notice': notice]) }}#}
    {#{% endfor %}#}
{#{% endif %}#}