{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}

    <div class="{{ class }}">
{% endif %}

{% if (strpos(key, 'form') === 0) %}
    {{ partial('form', ['form': part]) }}
{% endif %}

{% if helper.partDiv(key) %}
</div>
{% endif %}