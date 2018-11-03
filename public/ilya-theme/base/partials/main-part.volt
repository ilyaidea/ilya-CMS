{# main-part(key, part) #}

{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}
    {% set id = key %}

    <div class="{{ class }}" id="{{ id }}">
{% endif %}

{% if (strpos(key, 'form') === 0) %}
    {{ partial('form', ['form': part]) }}
{% endif %}

{% if (strpos(key, 'datatable') === 0) %}
    {{ partial('datatable/html', ['datatablekey': key,'datatable': part]) }}
{% endif %}

{% if (strpos(key, 'treemenu') === 0) %}
    {{ partial('treemenu-view', ['key': key,'data': part]) }}
{% endif %}

{% if helper.partDiv(key) %}
    </div>
{% endif %}