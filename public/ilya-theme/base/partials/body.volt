{{ partial('body/tags') }}
<body{{ body_tags('base', '') }}>

{#{{ partial('body/header') }}#}
{{ partial('body-content') }}
{#{{ partial('body/footer') }}#}
{#{{ partial('body/hidden') }}#}
{{ partial('body/script') }}

</body>