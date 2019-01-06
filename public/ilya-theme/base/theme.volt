{{ get_doctype() }}
{% set attribution = '<!-- Powered by IlyaIdea Company - https://www.ilyaidea.ir/ -->' %}
{% set fixed_topbar = false %}

<html{{ tag.getHtmlTags(true) }}>
    {{ attribution }}

    {{ partial('head') }}
    {{ partial('body') }}

    {{ attribution }}
</html>