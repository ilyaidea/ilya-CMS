{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}

    <div class="{{ class }}">
{% endif %}

{% if (strpos(key, 'form') === 0) %}
    {{ partial('form', ['form': part]) }}
{% endif %}

{% if (strpos(key, 'datatable') === 0) %}
    {{ partial('datatable/html', ['datatablekey': key,'datatable': part]) }}
{% endif %}

{% if (strpos(key, 'treemenu') === 0) %}
    {{ partial('treemenu', ['key': key,'data': part]) }}
{% endif %}

{% if helper.partDiv(key) %}
    </div>
{% endif %}