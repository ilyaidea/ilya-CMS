{# form_title(part) #}

{% set partTitle = (part['title'] is defined) ? part['title'] : null %}
{% set partTitleTags = (part['title_tags'] is defined) ? part['title_tags'] : null %}

{% if (strlen(partTitle)) or (strlen(partTitleTags)) %}
    <h2{{ rtrim(' '~ partTitleTags) }}>{{ partTitle }}</h2>
{% endif %}