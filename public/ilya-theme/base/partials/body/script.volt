<script>
    var b = document.getElementsByTagName('body')[0];
    b.className = b.className.replace('ilya-body-js-off', 'ilya-body-js-on');
</script>

{% if helper.content().getContent().getParts()['js'] is not empty %}
    {% for js in helper.content().getContent().getParts()['js'] %}
        <script type="text/javascript" src="{{ js }}"></script>
    {% endfor %}
{% endif %}

{{ partial('datatable/script') }}