<script>
    var b = document.getElementsByTagName('body')[0];
    b.className = b.className.replace('ilya-body-js-off', 'ilya-body-js-on');
</script>

{{ assets.outputJs() }}
{{ assets.outputInlineJs() }}

{#{{ partial('datatable/script') }}#}