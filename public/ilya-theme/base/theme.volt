{{ get_doctype() }}
{% set attribution = '<!-- Powered by IlyaIdea Company - https://www.ilyaidea.ir/ -->' %}
{% set theme = 'base' %}
{% set fixed_topbar = false %}

<html{{ helper.htmlTags().get() }}>
{{ attribution }}
{{ partial('head') }}
{{ partial('body') }}

{{ attribution }}
</html>