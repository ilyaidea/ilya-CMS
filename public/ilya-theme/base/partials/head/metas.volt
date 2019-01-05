{# head/metas() #}
<meta name="viewport" content="width=device-width, initial-scale=1"/>
{% if tag.getMetaDescription() is not null and strlen(tag.getMetaDescription()) %}
    {{ helper.output('<meta name="description" content="' ~ helper.content['description'] ~ '"/>') }}
{% endif %}

{% if tag.getMetaKeywords() is not empty and strlen(tag.getMetaKeywords()) %}
    {# as far as I know, meta keywords have zero effect on search rankings or listings #}
    {{ helper.output('<meta name="keywords" content="' ~ tag.getMetaKeywords(true) ~ '"/>') }}
{% endif %}