<script>
    {% if helper.content().getContent().getParts() is not empty %}
    {% for key, part in helper.content().getContent().getParts() %}

    {% if (strpos(key, 'datatable') === 0) %}
    {{ partial('datatable/script_builder', ['datatablekey': key, 'datatable': part]) }}
    {% endif %}

    {% endfor %}
    {% endif %}
</script>