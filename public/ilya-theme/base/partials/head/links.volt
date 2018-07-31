{% if helper.content['canonicial'] is defined %}
    {{ helper.output('<link rel="canonicial" href="' ~ helper.content['canonicial'] ~ '"/>') }}
{% endif %}

{% if helper.content['feed']['url'] is defined %}
    {{ helper.output('<link rel="alternate" type="application/rss+xml" href="' ~ helper.content['feed']['url'] ~ '" title="' ~ helper.content['feed']['label'] ~ '"/>') }}
{% endif %}

{# convert page links to rel=prev and rel=next tags #}
{% if helper.content['page_links']['items'] is defined %}
    {% for page_link in helper.content['page_links']['items'] %}
        {% if in_array(page_link['type'], ['prev', 'next']) %}
            {{ helper.output('<link rel="' ~ page_link['type'] ~ '" href="' ~ page_link['url'] ~ '" />') }}
        {% endif %}
    {% endfor %}
{% endif %}