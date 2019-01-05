{#{{ partial('content/body-prefix') }}#}
{#{{ partial('content/notices') }}#}

{#{{ partial(#}
    {#'widgets',#}
    {#[#}
        {#'region': 'full',#}
        {#'place' : 'top'#}
    {#]#}
{#) }}#}

{#{{ partial('body/content/header/index') }}#}

<div class="ilya-body-wrapper">

{#{{ partial(
    'widgets',
    [
        'region': 'full',
        'place' : 'high'
    ]
) }}#}
    <div class="ilya-main-wrapper">
        {{ partial('sidepanel-left') }}
        {{ partial('main') }}
        {{ partial('sidepanel-right') }}
    </div> <!-- END main-wrapper -->

    {#{{ partial(
        'widgets',
        [
            'region': 'full',
            'place' : 'low'
        ]
    ) }}#}
</div> <!-- END ilya-body-wrapper -->

{#
{{ partial(
    'widgets',
    [
        'region': 'full',
        'place' : 'bottom'
    ]
) }}#}
