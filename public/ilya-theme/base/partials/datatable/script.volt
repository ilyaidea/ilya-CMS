<script>
    {% if content is not empty %}
    {% for key, part in content %}

    {% if (strpos(key, 'datatable') === 0) %}
    {{ partial('datatable/script_builder', ['datatablekey': key, 'datatable': part]) }}
    {% endif %}

    {% endfor %}
    {% endif %}
</script>