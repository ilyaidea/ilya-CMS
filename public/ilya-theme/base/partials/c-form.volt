{# c-form(form) #}
{% set id = '' %}
{% if form['id'] is defined %}
    {% set id = ' id="'~form['id']~'"' %}
{% endif %}

{% set collapse = '' %}
{#{% if form['collapse'] is defined %}#}
    {#{% set collapse = ' style="display:none;"' %}#}
{#{% endif %}#}

<div class="ilya-c-form"{{ id }}{{ collapse }}>
    {{ partial('form', ['form': form]) }}
</div>