{# datatable(datatablekey, datatable) #}
<table id="{{ datatablekey }}" class="display">
    <thead>
    <tr>
        {% for title in datatable['titles'] %}
            <th>{{ title }}</th>
        {% endfor %}
    </tr>
    </thead>
</table>