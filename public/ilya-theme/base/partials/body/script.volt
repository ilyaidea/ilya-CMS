{{ helper.output(
    '<script>',
    "var b = document.getElementsByTagName('body')[0];",
    "b.className = b.className.replace('qa-body-js-off', 'qa-body-js-on');",
    '</script>'
) }}