{# tabs(key, datatable) #}
<div id="tabs_{{ key }}">
    <ul>
        <li data-dt="{{ key }}">
            <a href="#tabs_{{ key }}-1">{{ datatable.getTitle() }}</a>
        </li>
        {% set index = 2 %}
        {% for name, sibl in datatable.getSibling() %}
            <li data-dt="{{ sibl.prefix }}">
                <a href="#tabs_{{ key }}-{{ index }}">{{ sibl.getTitle() }}</a>
            </li>
            {% set index = index + 1 %}
        {% endfor %}
    </ul>
    <div id="tabs_{{ datatable.prefix }}-1">
        {{ partial('datatable/alerts/success', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
        {{ partial('datatable/alerts/error', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
        {{ partial('datatable/alerts/warning', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
        {{ partial('datatable/alerts/notice', ['prefix': datatable.prefix, 'dataTable': datatable]) }}
        <table id="{{ key }}" class="cell-border" data-dt="{{ key }}" style="width: 100%;"></table>
    </div>
    {% set index = 2 %}
    {% for prefix, sibl in datatable.getSibling() %}
        {% set prefix = sibl.prefix %}
        <div id="tabs_{{ key }}-{{ index }}">
            {{ partial('datatable/alerts/success', ['prefix': prefix, 'dataTable': datatable]) }}
            {{ partial('datatable/alerts/error', ['prefix': prefix, 'dataTable': datatable]) }}
            {{ partial('datatable/alerts/warning', ['prefix': prefix, 'dataTable': datatable]) }}
            {{ partial('datatable/alerts/notice', ['prefix': prefix, 'dataTable': datatable]) }}
            <table id="{{ sibl.prefix }}" class="cell-border" data-dt="{{ sibl.prefix }}" style="width: 100%;"></table>
        </div>
        {% set index = index + 1 %}
    {% endfor %}
</div>