{#{{ partial('body/tags') }}#}
<body>
{#<body{{ body_tags(theme, fixed_topbar) }}>#}

{{ partial('body_script') }}
{#{{ partial('body_header') }}#}
{{ partial('body_content') }}
{#{{ partial('body_footer') }}#}
{#{{ partial('body_hidden') }}#}

</body>