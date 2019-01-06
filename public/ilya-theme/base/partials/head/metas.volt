{# head/metas() #}
<meta name="viewport" content="width=device-width, initial-scale=1"/>
{% if tag.getMetaDescription() is not null and strlen(tag.getMetaDescription()) %}
    <meta name="description" content="{{ tag.getMetaDescription() }}"/>
{% endif %}

{% if tag.getMetaKeywords() is not empty and strlen(tag.getMetaKeywords(true)) %}
    {# as far as I know, meta keywords have zero effect on search rankings or listings #}
    <meta name="keywords" content="{{ tag.getMetaKeywords(true) }}"/>
{% endif %}