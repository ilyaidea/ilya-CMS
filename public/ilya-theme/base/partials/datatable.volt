{# datatable(key, datatable) #}
{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}
    {% set id = 'part_'~key %}

    <div class="{{ class }}" id="{{ id }}">
{% endif %}

{% if datatable.getSibling() is not empty %}
    {{ partial('datatable/tabs', ['key': key, 'datatable': datatable]) }}
{% else %}
    {{ partial('datatable-title', ['dataTable': datatable]) }}
    {{ partial('datatable/alerts/success', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
    {{ partial('datatable/alerts/error', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
    {{ partial('datatable/alerts/notice', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
    {{ partial('datatable/alerts/warning', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
    <table id="{{ key }}" class="cell-border" style="width: 100%;"></table>
{% endif %}

{% if helper.partDiv(key) %}
    </div>
{% endif %}