{% set pagetitle = strlen(helper.request) ? helper.content['title']|striptags : '' %}
{% set headtitle = (strlen(pagetitle) ? pagetitle ~ ' - ' : '' ) ~ helper.content['site_title'] %}

{{ helper.output('<title' ~ headtitle ~ '</title>') }}