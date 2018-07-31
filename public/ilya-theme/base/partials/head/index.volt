{{ helper.output(
    '<head>',
    '<meta charset="' ~ helper.content['charset'] ~ '"/>'
) }}

{{ partial('head/title') }}
{{ partial('head/metas') }}
{{ partial('head/css') }}
{{ partial('head/links') }}
{{ partial('head/lines') }}
{{ partial('head/script') }}
{{ partial('head/custom') }}

{{ helper.output('<head>') }}