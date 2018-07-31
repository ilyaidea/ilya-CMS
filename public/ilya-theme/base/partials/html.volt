{% set attribution = '<!-- Powered by IlyaIdea Company - https://www.ilyaidea.ir/ -->' %}

{% set extratags = (helper.content['html_tags'] is defined) ? helper.content['html_tags'] : '' %}

{{ helper.output(
    '<html ' ~ extratags ~ '>',
    attribution
) }}

{{ partial('head/index') }}

{{ partial('body/index') }}

{{ helper.output(
    attribution,
    '</html>',
) }}