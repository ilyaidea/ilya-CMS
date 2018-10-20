{% if strlen(helper.content['description']) %}
    {{ helper.output('<meta name="description" content="' ~ helper.content['description'] ~ '"/>') }}
{% endif %}

{% if strlen(helper.content['keywords']) %}
    {# as far as I know, meta keywords have zero effect on search rankings or listings #}
    {{ helper.output('<meta name="keywords" content="' ~ helper.content['keywords'] ~ '"/>') }}
{% endif %}